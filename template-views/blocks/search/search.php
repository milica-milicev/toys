<div class="recente-post__item">
	<a href="<?php the_permalink(); ?>">
		<div class="recente-post__item-image">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/_demo/recente-post1.jpg" alt="">
			<!-- <span class="recente-post__item-image-tag">Edukacija</span> -->
		</div>
		<h4 class="recente-post__item-title"><?php the_title(); ?></h4>
		<p class="recente-post__item-desc"><?php the_excerpt(); ?></p>
		<div class="recente-post__item-btn">
			<span class="btn">Pročitajte više</span>
		</div>
	</a>
</div>