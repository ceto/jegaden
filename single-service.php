<?php while (have_posts()) : the_post(); ?>
    <article class="theservice">
        <?php get_template_part('templates/service', 'header'); ?>
        <section class="ps theservice__section">
            <div class="grid-container grid-container--xnarrow">
                <div class="copywrite">
                    <?php if (has_excerpt()) : ?>
                    <div class="lead"><?php the_excerpt() ?></div>
                    <?php endif; ?>

                    <?php the_content(); ?>
                </div>
            </div>
        </section>
        <?php if( have_rows('sections') ): ?>
        <?php while ( have_rows('sections') ) : the_row(); ?>
        <section class="ps theservice__section">
            <div class="grid-container grid-container--xnarrow">
                <div class="copywrite">
                    <?php the_sub_field('content'); ?>
                </div>
            </div>
        </section>
        <?php endwhile; ?>
    </article>

<?php endif; ?>



<?php endwhile; ?>
