<?php use Roots\Sage\Titles; ?>

<div class="pagehead pagehead--service">
    <div class="pagehead__content grid-container grid-container--xnarrow">
        <p class="pagehead__subtitle"><a href="<?php the_permalink( 55 ); ?>"><?php _e('Services','jegaden') ?></a></p>
        <h1 class="pagehead__title"><?= Titles\title(); ?></h1>
    </div>
    <figure class="pagehead__bg">
        <img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/homehero.jpg" alt="">
    </figure>
</div>
