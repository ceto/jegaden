<?php if ( !is_paged() ) : ?>
<?php
    $args = array(
        'posts_per_page'      => 2,
        'post__in'            => get_option( 'sticky_posts' ),
        'ignore_sticky_posts' => 1,
    );
    $stickyposts = new WP_Query( $args );
?>
<section class="patientresources ps ps--light ps--bordered">
    <div class="grid-container grid-container--xnarrow">
        <h2><?php _e('Patient Resources','jegaden') ?></h2>
        <ul class="resourcelist">
            <?php while ($stickyposts->have_posts()) : $stickyposts->the_post(); ?>
                <?php setup_postdata( $post ); ?>
                <li>
                    <div class="rescard">
                        <h3 class="rescard__title"><?php the_title(); ?></h3>
                        <div class="rescard__text"><?php the_excerpt(); ?></div>
                        <a href="<?php the_permalink(); ?>" class="rescard__more button"><?php _e('Read more','jegaden') ?></a>
                    </div>
                </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php $i=0; while ( $i++ < $stickyposts->post_count ) {
                the_post();
            } ?>
        </ul>
    </div>

</section>
<?php endif; ?>
