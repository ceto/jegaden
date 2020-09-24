<?php use Roots\Sage\Titles; ?>

<div class="pagehead pagehead--post">
    <div class="pagehead__content grid-container grid-container--xnarrow">
        <p class="pagehead__subtitle"><a href="<?php the_permalink( get_option( 'page_for_posts' )); ?>"><?php _e('Patient Resources','jegaden') ?></a></p>
        <h1 class="pagehead__title"><?= Titles\title(); ?></h1>
    </div>
    <figure class="pagehead__bg">
        <img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/homehero.jpg" alt="">
    </figure>
</div>
