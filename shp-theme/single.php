<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- ============================================================
     SINGLE POST HEADER
     ============================================================ -->
<div class="single-header">
	<div class="container--narrow">
		<?php
		$cats = get_the_category();
		if ( $cats ) :
		?>
		<a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>" class="post-eyebrow"><?php echo esc_html( $cats[0]->name ); ?></a>
		<?php endif; ?>

		<h1 class="single-title"><?php the_title(); ?></h1>

		<div class="post-meta-row">
			<span>
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
				<?php echo esc_html( get_the_date( 'd M Y' ) ); ?>
			</span>
			<span>
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
				<?php the_author(); ?>
			</span>
			<span><?php echo esc_html( shp_post_read_time() ); ?></span>
		</div>
	</div>
</div>

<?php if ( has_post_thumbnail() ) : ?>
<div class="container" style="margin-bottom:3rem;">
	<?php the_post_thumbnail( 'shp-wide', [ 'class' => 'single-featured-img', 'alt' => get_the_title() ] ); ?>
</div>
<?php endif; ?>

<!-- ============================================================
     POST CONTENT
     ============================================================ -->
<div class="single-content">
	<div class="container--narrow">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<?php
		// Pagination for long posts
		wp_link_pages( [
			'before' => '<nav class="page-links"><span>' . __( 'Pages:', 'shp' ) . '</span>',
			'after'  => '</nav>',
		] );
		?>

		<!-- Tags -->
		<?php if ( has_tag() ) : ?>
		<div class="post-tags">
			<?php the_tags( '', '', '' ); ?>
		</div>
		<?php endif; ?>

		<!-- Prev / Next -->
		<nav class="post-nav" aria-label="<?php esc_attr_e( 'Post navigation', 'shp' ); ?>">
			<?php
			$prev = get_previous_post();
			$next = get_next_post();
			?>
			<div class="post-nav__item post-nav__item--prev">
				<span class="post-nav__dir">&larr; <?php echo shp_t( 'Bài Trước', 'Previous' ); ?></span>
				<?php if ( $prev ) : ?>
				<a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="post-nav__title"><?php echo esc_html( get_the_title( $prev ) ); ?></a>
				<?php else : ?>
				<span class="post-nav__title text-muted">&mdash;</span>
				<?php endif; ?>
			</div>
			<div class="post-nav__item post-nav__item--next">
				<span class="post-nav__dir"><?php echo shp_t( 'Bài Tiếp', 'Next' ); ?> &rarr;</span>
				<?php if ( $next ) : ?>
				<a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="post-nav__title"><?php echo esc_html( get_the_title( $next ) ); ?></a>
				<?php else : ?>
				<span class="post-nav__title text-muted">&mdash;</span>
				<?php endif; ?>
			</div>
		</nav>
	</div>
</div>

<!-- ============================================================
     RELATED POSTS
     ============================================================ -->
<?php
$current_cats = wp_get_post_categories( get_the_ID() );
$related_args = [
	'posts_per_page'      => 3,
	'post__not_in'        => [ get_the_ID() ],
	'category__in'        => $current_cats,
	'ignore_sticky_posts' => 1,
];
$related = new WP_Query( $related_args );
?>

<?php if ( $related->have_posts() ) : ?>
<section class="related-posts section">
	<div class="container">
		<p class="section-label"><?php echo shp_t( 'Có Thể Bạn Thích', 'You Might Also Like' ); ?></p>
		<div class="grid-3">
			<?php while ( $related->have_posts() ) : $related->the_post(); ?>
			<article class="post-card">
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-card__thumb">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'shp-card', [ 'alt' => get_the_title() ] ); ?>
					</a>
				</div>
				<?php endif; ?>
				<div class="post-card__meta">
					<?php
					$rcats = get_the_category();
					if ( $rcats ) :
					?>
					<a href="<?php echo esc_url( get_category_link( $rcats[0]->term_id ) ); ?>" class="post-card__cat"><?php echo esc_html( $rcats[0]->name ); ?></a>
					<?php endif; ?>
					<span class="post-card__date"><?php echo get_the_date( 'd M Y' ); ?></span>
				</div>
				<h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
