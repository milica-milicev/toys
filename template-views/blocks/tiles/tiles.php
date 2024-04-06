<div class="tiles">
	<div class="container">
		<div class="section-head">
			<h2 class="section-head__title">Veliki izbor igračaka za sve uzraste</h2>
			<p class="section-head__subtitle">Pronađite baš ono što je prilagođeno polu i uzrastu deteta</p>
		</div>
		<div class="tiles__container">
			<?php
			$categories = get_field('categories');

			// Proverite da li postoji niz proizvoda na akciji
			if ($categories) :
				for ($i = 1; $i <= 3; $i++) :
					$category_field = 'category_' . $i;
					$category_id = $categories[$category_field]->term_id;
					$term = get_term_by('id', $category_id, 'product_cat');
        
        			if ($term) :
						// Dobijanje URL-a kategorije
						$term_link = get_term_link($term);
						$term_name = $term->name;
						$thumbnail_data = get_field('background_thumbnail', 'product_cat_' . $category_id);

						// Zatim, proverite da li vrednost postoji i da li je to niz sa ključem 'url'
						if (is_array($thumbnail_data) && isset($thumbnail_data['url'])) :
							$image_url = $thumbnail_data['url'];
						else :
							// Ako nema slike, koristite placeholder
							$image_url = get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg';
						endif;
						?>
						<div class="tile-item">
							<a href="<?php echo $term_link; ?>">
								<div class="tile-item__wrap" style="background-image: url(<?php echo $image_url; ?>)">
									<h4 class="tile-item__title"><?php echo $term_name; ?></h4>
									<span class="btn btn--white">Pogledaj ponudu</span>
								</div>
							</a>
						</div>
					<?php endif; ?>
				<?php endfor; ?>
			<?php endif; ?>
		</div>
		<div class="tiles__container">
			<?php
			$age_ranges = get_field_object('field_65f94e27961f5'); // 'field_key'

			if ($age_ranges && isset($age_ranges['choices'])) :
				foreach ($age_ranges['choices'] as $key => $value) : ?>
					<div class="tile-item tile-item--sm">
						<a class="js-tile-item" href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" data-age-range="<?php echo esc_attr($key); ?>">
							<div class="tile-item__wrap--sm">
								<h4 class="tile-item__title tile-item__title--xl"><?php echo esc_html($value); ?></h4>
							</div>
						</a>
					</div>
				<?php
				endforeach;
			endif; ?>
		</div>
		<div class="tiles__btn">
			<a class="btn" href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">Sve igračke</a>
		</div>
	</div>
</div>