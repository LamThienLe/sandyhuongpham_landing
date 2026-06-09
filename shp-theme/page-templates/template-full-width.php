<?php
/**
 * Template Name: Full Width
 * Template Post Type: page
 */

get_header();

while ( have_posts() ) : the_post();
?>

<div class="page-hero">
	<div class="container">
		<h1 class="page-hero__title"><?php the_title(); ?></h1>
	</div>
</div>

<div class="container" style="max-width:100%;padding-bottom:5rem;">
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</div>

<?php
endwhile;

get_footer();
