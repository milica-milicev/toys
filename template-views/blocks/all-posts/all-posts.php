<div class="blog">
    <div class="container container--sm">

        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Trenutna stranica

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3, // Prikazujemo 4 posta na svim stranicama
            'paged' => $paged // Postavljamo trenutnu stranicu
        );

        $all_posts = new WP_Query($args);

        if ($all_posts->have_posts()) : ?>
            <div class="blog__container">
                <?php
                while ($all_posts->have_posts()) : $all_posts->the_post();
                    // Svi postovi idu ovde, uključujući i prvi post
                    ?>
                    <div class="blog-item">
                        <div class="blog-item__img">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('medium');
                                } else {
                                    // Putanja do vaše placeholder slike za standardne postove
                                    $placeholder_url = get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg';
                                    echo '<img src="' . esc_url($placeholder_url) . '" alt="Placeholder" />';
                                }
                                ?>
                            </a>
                        </div>
                        <div class="blog-item__content">
                            <div class="blog-item__content-wrap">
                                <h3><?php the_title(); ?></h3>
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                            <div class="blog-item__btn">
                                <a class="btn" href="<?php the_permalink(); ?>">Pročitajte više</a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>
            <div class="pagination">
                <?php
                echo paginate_links(array(
                    'total' => $all_posts->max_num_pages,
                    'prev_text' => 'Prethodno',
                    'next_text' => 'Sledeće'
                ));
                ?>
            </div>
            <?php
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>
