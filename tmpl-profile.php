<?php
/**
 * Template Name: Profile Page Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/profile', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php get_template_part('templates/testimonials'); ?>
<?php get_template_part('templates/logos'); ?>
<?php endwhile; ?>
