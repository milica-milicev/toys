<div class="search-blocks__item">
	<a href="<?php the_permalink(); ?>">
		<div class="search-blocks__item-image">
			<?php 
				if ('product' === get_post_type()) { // Proverava da li je trenutni post proizvod
					$product_id = get_the_ID();
					$product = wc_get_product($product_id);
					$image_url = wp_get_attachment_url($product->get_image_id());

					if (!$image_url) {
						// Putanja do vaše placeholder slike
						$image_url = get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg';
					}

					echo '<img class="lazy" src="' . esc_url($image_url) . '" alt="' . get_the_title() . '">';

				} else { // Za standardne postove koji nisu proizvodi
					if (has_post_thumbnail()) {
						the_post_thumbnail('medium');
					} else {
						// Putanja do vaše placeholder slike za standardne postove
						$placeholder_url = get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg';
						echo '<img class="lazy" src="' . esc_url($placeholder_url) . '" alt="Placeholder" />';
					}
				}
			?>
		</div>
		<h4 class="search-blocks__item-title"><?php the_title(); ?></h4>
		<?php 
			if ('product' === get_post_type()) { // Proverava da li je trenutni post proizvod
				$product_id = get_the_ID();
				$product = wc_get_product($product_id);
				$product_price = $product->get_price_html();

				echo '<span class="product-price">' . $product_price . '</span>';
			} else {
				echo '<p class="recente-post__item-desc">' . get_the_excerpt() . '</p>';
			}
		?>
		<div class="search-blocks__item-btn">
			<?php
				if ('product' === get_post_type()) :
					$read_more_text = 'Pogledajte proizvod';
				else :
					$read_more_text = 'Pročitajte više';
				endif; 
			?>
			<span class="btn"><?php echo $read_more_text; ?></span>
		</div>
	</a>
</div>