<?php
/*
 * Template Name: BlastChat KeepSession
 * The template for BlastChat KeepSession functionality.
 */
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; ?>