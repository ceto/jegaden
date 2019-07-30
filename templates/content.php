<article <?php post_class('articlecard'); ?>>
    <div class="grid-container grid-container--xnarrow">
        <header>
            <h2 class="articlecard__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php get_template_part('templates/entry-meta'); ?>
        </header>
        <div class="articlecard__lead lead"><?php the_excerpt() ?></div>
        <a href="<?php the_permalink(); ?>" class="readmore button small"><?php _e('Read more','jegaden') ?></a>
    </div>
</article>

