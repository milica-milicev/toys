<div class="single-post">
    <div class="single-post__image">
        <?php 
        if (has_post_thumbnail()) {
            the_post_thumbnail('medium');
        } else {
            // Putanja do vaše placeholder slike za standardne postove
            $placeholder_url = get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg';
            echo '<img src="' . esc_url($placeholder_url) . '" alt="Placeholder" />';
        }
        ?>
    </div>
    <div class="single-post__content">
        <span class="single-post__date"><?php the_date('j. F Y.'); ?></span>
        <h1 class="single-post__title"><?php the_title(); ?></h1>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</div>