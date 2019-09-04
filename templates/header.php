<div class="grid-container">
    <header class="banner">
        <a class="banner__brand" href="<?= esc_url(home_url('/')); ?>">
            <div class="textlogo">
                Prof. Olivier Jegaden, MD, PHD.
                <span>Cardiac Surgeon Professor of Cardiac Surgery</span>
            </div>
        </a>
        <nav class="banner__nav">
            <?php
                if (has_nav_menu('primary_navigation')) :
                wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'mainmenu']);
                endif;
            ?>
        </nav>
        <div class="banner__actions">
            <a target="_blank" href="https://wa.me/971589258515"><svg class="icon"><use xlink:href="#icon-phone"></use></svg>971 5892 58515</a>
        </div>
    </header>
</div>
