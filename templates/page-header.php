<?php use Roots\Sage\Titles; ?>

<div class="pagehead">
    <div class="pagehead__content grid-container grid-container--xnarrow">
        <h1 class="pagehead__title"><?= Titles\title(); ?></h1>
    </div>
    <figure class="pagehead__bg">
        <?php if ( $heroimg=get_field('heroimg',$post->ID) ) : ?>
        <?php echo wp_get_attachment_image( $heroimg['id'], 'full' ); ?>
        <?php else : ?>
        <img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/homehero.jpg" alt="">
        <?php endif; ?>
    </figure>
</div>