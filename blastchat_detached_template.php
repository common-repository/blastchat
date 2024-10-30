<?php
/*
 * Template Name: BlastChat Detached
 * The template for displaying BlastChat in detached mode.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<?php
	wp_head();
	echo "\n<style type=\"text/css\">\nhtml, body, #blastchatchat {top:0; left:0; height: 100%; width: 100%; padding: 0 !important; margin: 0 !important; border: 0; overflow: hidden; position: absolute;}\n#header {margin: 0px;}</style>";
?>
</head>

<body <?php body_class(); ?>>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; ?>
</body>
</html>