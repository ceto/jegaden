<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/hero'); ?>
  <?php get_template_part('templates/servicelist'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>