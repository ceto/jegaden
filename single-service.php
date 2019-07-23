<?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/service', 'header'); ?>
    <div class="ps">
        <div class="grid-container grid-container--narrow">
            <div class="grid-x grid-margin-x align-center">
                <div class="cell">
                    <?php if (has_excerpt()) : ?>
                    <div class="lead"><?php the_excerpt() ?></div>
                    <?php endif; ?>
                    <div class="copy">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php endwhile; ?>
