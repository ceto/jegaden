<?php
    $the_testimonials = new WP_Query( array(
        'posts_per_page'      => -1,
        'post_type' => array(testimonial),
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    $tc=$the_testimonials->found_posts;
?>


<section class="testiblock">
    <div class="grid-container grid-container--xnarrow">
        <h2><?php _e('Testimonials','jegaden') ?></h2>
        <div class="testipanel">
            <div class="orbit" role="region" aria-label="testimonils" data-orbit data-options="animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;">
                <div class="orbit-wrapper">
                    <ul id="testilist" class="testilist orbit-container">
                        <?php $iter=0; while ($the_testimonials->have_posts() ) : $the_testimonials->the_post();  ?>
                            <?php setup_postdata( $post ); ?>
                            <li class="testilist__item orbit-slide <?= ($iter==0)?'is-active':''; ?>" >
                                <div>
                                    <blockquote class="testimonial">
                                        <?php the_content() ?>
                                        <cite><?php the_title(); ?></cite>

                                    </blockquote>
                                </div>
                            </li>
                        <?php $iter++; endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </ul>
                    <nav class="orbit-bullets">
                        <button class="is-active" data-slide="0"></button>
                        <?php for ($i=1; $i < $tc; $i++) : ?>
                        <button data-slide="<?= $i ?>"></button>
                        <?php endfor; ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
