<div class="cards">
	<div class="container">
		<div class="section-head">
			<h2 class="section-head__title">Pronađite igračku i obradujte dete</h2>
			<p class="section-head__subtitle">Podelili smo naše igračke u četiri glavne kategorije</p>
		</div>
		<div class="cards__container">
		<?php
			$isolated_categories = get_field('isolated_categories');

			// Proverite da li postoji niz proizvoda na akciji
			if ($isolated_categories) :
				for ($i = 1; $i <= 4; $i++) :
					$category_field = 'category_' . $i;
					$category_id = $isolated_categories[$category_field]->term_id;
					$term = get_term_by('id', $category_id, 'product_cat');
        
        			if ($term) :
						// Dobijanje URL-a kategorije
						$term_link = get_term_link($term);
						$term_name = $term->name;
						$short_desc = get_field('short_description', 'product_cat_' . $category_id);
						$card_theme = get_field('card_theme', 'product_cat_' . $category_id);
						$background_img = get_field('background_img', 'product_cat_' . $category_id);
						$img_in_corner = get_field('img_in_corner', 'product_cat_' . $category_id);
						
						if ($background_img === 'full_img') :
							$thumbnail_data = get_field('background_thumb', 'product_cat_' . $category_id);
							// Zatim, proverite da li vrednost postoji i da li je to niz sa ključem 'url'
							if (is_array($thumbnail_data) && isset($thumbnail_data['url'])) :
								$background = 'background-image: url(' . $thumbnail_data['url'] . ')';
							else :
								// Ako nema slike, koristite placeholder
								$background = 'background-image: ' . get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg';
							endif;
						else : 
							$background_color = $img_in_corner['background_color'];
							$image = $img_in_corner['image']['url'];
							$background = 'background-color: ' . $background_color;
						endif; ?>

						<div class="card-item">
							<a href="<?php echo $term_link; ?>">
								<div class="card-item__wrap" style="<?php echo $background ; ?>">
									<?php if ($background_img === 'corner_img') : ?>
										<img class="card-item__img" src="<?php echo $image; ?>" alt="">
									<?php endif; ?>
									<p class="card-item__pretitle card-item__pretitle--<?php echo $card_theme; ?>"><?php echo $short_desc; ?></p>
									<h3 class="card-item__title card-item__title--<?php echo $card_theme; ?>"><?php echo $term_name; ?></h3>
									<div class="card-item__btn">
										<span class="btn btn--white">Pogledaj ponudu</span>
									</div>
								</div>
							</a>
						</div>
					<?php endif; ?>
				<?php endfor; ?>
			<?php endif; ?>
		</div>
	</div>
</div>