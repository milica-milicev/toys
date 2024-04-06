<div class="isolated-product">
	<div class="container container--sm">
		<?php
		$isolated_product = get_field('isolated_product');

		// Proverite da li postoji niz popularnih proizvoda
		if ($isolated_product) : 
			$product_sel = $isolated_product['product'];
			// Proveravamo da li post object postoji
			if ($product_sel) :
				global $product;
				$product_id = $product_sel->ID;
				$product = wc_get_product($product_id);
				$product_thumb = get_the_post_thumbnail($product_id, 'shop_catalog');
				$product_title = get_the_title($product_id);
				$product_link = get_the_permalink($product_id);
				$product_price = $product->get_price_html();
				$short_descr = $product->get_short_description();
				// main image ID
				$post_thumbnail_id = $product->get_image_id();
				// gallery images IDs
				$attachment_ids = $product->get_gallery_image_ids();
				?>
				<div class="isolated-product__container">
				
					<div class="product__main-gallery">
						<?php get_template_part('woocommerce/single-product/product-image' ); ?>
					</div>
					
					<div class="isolated-product__content">
						<?php if ($product->is_on_sale()) : ?>
							<span class="isolated-product__content-tag">Akcija!</span>
						<?php endif; ?>
						<h2 class="isolated-product__content-title"><a href="<?php echo $product_link ?>"><?php echo $product_title; ?></a></h2>
						<div class="isolated__product-price__wrap">
							<div class="isolated__product-price"><span class="price"><?php echo $product_price; ?></span></div>
							<div class="isolated__product-btn product-item__btn">
								<?php woocommerce_template_loop_add_to_cart(); ?>
							</div>
						</div>
						<div class="isolated-product__content-desc entry-content">
							<?php echo wpautop($short_descr); ?>
						</div>
						<a class="link" href="<?php echo $product_link; ?>">Još informacija</a>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>