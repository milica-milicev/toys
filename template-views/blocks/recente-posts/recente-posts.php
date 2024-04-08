<?php
 $args = array(
	'post_type' => 'post', // Tip posta koji želite da dohvatite
	'posts_per_page' => 3, // Broj postova koje želite da prikažete
	'orderby' => 'date', // Poređajte ih po datumu
	'order'   => 'DESC' // U opadajućem redosledu, da najnoviji budu prvi
);

$query = new WP_Query($args);
?>

<div class="recente-posts">
	<div class="container">
		<div class="section-head">
			<h2 class="section-head__title">Najnoviji blog postovi:</h2>
		</div>
		<?php if ($query->have_posts()) : ?>
			<div class="recente-posts__container">
				<?php
				while($query->have_posts()): $query->the_post();
					$title = get_the_title();
					$link = get_permalink();
					$excerpt = get_the_excerpt();

					if ( has_post_thumbnail() ) :
						$thumbnail_url = get_the_post_thumbnail_url(); 
					else :
						$thumbnail_url = get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg';
					endif;
					?>
					<div class="recente-post__item">
						<a href="<?php echo $link; ?>">
							<div class="recente-post__item-image">
								<img src="<?php echo $thumbnail_url; ?>" alt="">
								<!-- <span class="recente-post__item-image-tag">Edukacija</span> -->
							</div>
							<h4 class="recente-post__item-title"><?php echo $title; ?></h4>
							<p class="recente-post__item-desc"><?php echo $excerpt; ?></p>
							<div class="recente-post__item-btn">
								<span class="btn">Pročitajte više</span>
							</div>
						</a>
					</div>
				<?php endwhile;
				wp_reset_postdata(); // Resetujemo post podatke da ne bi došlo do konflikta u globalnom WP query-ju
				?>
			</div>
		<?php else :
			echo 'Nema postova.';
		endif;
		?>
		<div class="recente-posts__btn">
			<a class="btn btn--sec" href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Pogledaj naš ceo blog</a>
		</div>
	</div>
</div>