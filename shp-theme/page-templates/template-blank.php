<?php
/**
 * Template Name: Blank Canvas (Elementor)
 * Template Post Type: page
 *
 * Bare canvas — skips header, connect section, and footer.
 * Ideal for Elementor full-page layouts.
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class( 'template-blank' ); ?>>
<?php wp_body_open(); ?>

<main id="main-content">
	<?php
	while ( have_posts() ) : the_post();
		the_content();
	endwhile;
	?>
</main>

<?php wp_footer(); ?>
</body>
</html>
