<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="page-hero">
	<div class="container">
		<h1 class="page-hero__title"><?php the_title(); ?></h1>
	</div>
</div>

<div class="container" style="padding-bottom:5rem;">
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
