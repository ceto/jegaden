<section class="hero" data-magellan data-mage>
    <div class="hero__inner grid-container grid-container--narrow">
        <div class="hero__content">
            <p class="hero__subcaption">
                <?php _e('Minimally Invasive and Robotic Surgery, Cardiac Valve Repair, Coronary bypass Surgery','jegaden') ?>
            </p>
            <h2 class="hero__caption">"<?php _e('An Experience you can trust','jegaden') ?>"</h2>
            <a href="#services" class="hero__action button"><?php _e('Read More','jegaden') ?></a>
        </div>
        <figure class="hero__fig">
            <?php if ( $image = get_field('hero_image') ) : ?>
                <?php //var_dump($image); ?>
                <?php echo wp_get_attachment_image( $image['id'], 'full' ); ?>
            <?php else: ?>
                <img src="<?= get_stylesheet_directory_uri(); ?>/dist/images/profojegaden_resized.png" alt="" />
            <?php endif; ?>
        </figure>
    </div>
</section>
