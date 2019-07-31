<?php
/**
 * Template Name: Service Lister Page Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/services', 'header'); ?>
  <?php get_template_part('templates/servicelist'); ?>
  <?php //get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
