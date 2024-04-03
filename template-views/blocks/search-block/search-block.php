<div class="recente-post__item">
	<a href="<?php the_permalink(); ?>">
		<div class="recente-post__item-image">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/_demo/recente-post1.jpg" alt="">
			<!-- <span class="recente-post__item-image-tag">Edukacija</span> -->
		</div>
		<h4 class="recente-post__item-title"><?php the_title(); ?></h4>
		<div class="recente-post__item-btn">
			<?php
				if ($post->post_type == 'product') :
					$read_more_text = 'Pogledajte proizvod';
				else :
					$read_more_text = 'Pročitajte više';
				endif; 
			?>
			<span class="btn"><?php echo $read_more_text; ?></span>
		</div>
	</a>
</div>