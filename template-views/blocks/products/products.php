<div class="products">
	<div class="container">
		<div class="section-head">
			<h1 class="section-head__title">NAŠE NAJPRODAVANIJE IGRAČKE</h1>
			<p class="section-head__subtitle">Najpopularniji izbor i najveći broj pozitivnih komentara i prodaja su ostvarile ove igračke:</p>
		</div>
		<div class="products__container">
			<?php
			$popular_products = get_field('popular_products');

			// Proverite da li postoji niz popularnih proizvoda
			if ($popular_products) :
				// Petlja kroz svaki proizvod (product_1, product_2, itd.)
				for ($i = 1; $i <= 8; $i++) :
					// Dinamički generišemo ime polja
					$product_field_name = 'product_' . $i;
					
					// Dobijamo post object za svaki proizvod
					$product_post = $popular_products[$product_field_name];
					
					// Proveravamo da li post object postoji
					if ($product_post) :
						global $product;
						$product_id = $product_post->ID;
						$product = wc_get_product($product_id);
						$product_thumb = get_the_post_thumbnail($product_id, 'shop_catalog');
						$product_title = get_the_title($product_id);
						$product_link = get_the_permalink($product_id);
						$product_price = $product->get_price_html();
						?>
						<div class="product-item">
							<div class="product-item__wrap">
								<div class="product-item__img">
									<a href="<?php echo $product_link ?>">
										<?php echo $product_thumb; ?>
										<?php if ($product->is_on_sale()) : ?>
											<span class="product-item__tag product-item__tag--action">Akcija!</span>
										<?php endif; ?>
									</a>
								</div>
								<div class="product-item__info">
									<h2 class="product-item__name"><a href="<?php echo $product_link ?>"><?php echo $product_title; ?></a></h2>
									<div class="product-item__price">
										<?php echo $product_price; ?>
									</div>
									<div class="product-item__btn">
										<?php woocommerce_template_loop_add_to_cart(); ?>
									</div>
								</div>
							</div>
						</div>
						<?php
					endif;
				endfor;
			endif;
			?>
		</div>
		<div class="products__btn">
			<a class="btn btn--sec" href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">Pogledaj sve igracke</a>
		</div>
	</div>
</div>