<section class="hero hero--notop">
    <div class="hero__content">
        <h2 class="hero__caption"><?php the_field('hero_caption'); ?>Lorem, ipsum dolor. </h2>
        <p class="hero__subcaption">
            <?php the_field('hero_subcaption'); ?>Lorem ipsum dolor sit amet.
        </p>
        <a href="<?php the_field('hero_btntarget'); ?>" class="fauxbtn"><?php the_field('hero_btntext'); ?>Lorem, ipsum.</a>
    </div>
    <figure class="hero__fig">
        <?php if ( $image = get_field('hero_image') ) : ?>
            <?php //var_dump($image); ?>
            <?php echo wp_get_attachment_image( $image['id'], 'full' ); ?>
        <?php else: ?>
            <img src="<?= get_stylesheet_directory_uri(); ?>/dist/images/profojegaden_resized.png" alt="" />
        <?php endif; ?>
    </figure>
</section>
