<div id="services" class="serviceblock ps ps--light ps--bordered" data-magellan-target="services">
    <div class="grid-container grid-container grid-container--xnarrow">
        <?php if (!is_page_template('tmpl-services.php')) : ?>
        <h2><?php _e('Services','jegaden') ?></h2>
        <p><?php _e('Learn more about our services, click for details.','jegaden') ?></p>
        <br><br>
        <?php endif; ?>
        <?php
            $servicecats = get_terms( array(
                'taxonomy' => 'servicecat',
                'hide_empty' => false,
            ));
        ?>
        <section class="alltheservices">
            <?php foreach ($servicecats as $servicecat ) : ?>
                <?php
                    $args = array(
                            'post_type' => array('service'),
                            'order'               => 'ASC',
                            'orderby'             => 'menu_order',
                            'posts_per_page'         => -1,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'servicecat',
                                    'field'    => 'term_id',
                                    'terms'    => array($servicecat->term_id),
                                ),
                            ),
                        );
                        $the_services = new WP_Query( $args );
                ?>
                <div class="alltheservices__item">
                    <h3><?= $servicecat->name ?></h3>
                    <ul class="servicelist">
                    <?php while ($the_services->have_posts()) : $the_services->the_post(); ?>
                        <?php setup_postdata( $post ); ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; ?>
                    </ul>
                    <?php wp_reset_postdata(); ?>
                </div>


            <?php endforeach; ?>
        </section>
    </div>
</div>
