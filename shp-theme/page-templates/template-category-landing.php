<?php
/**
 * Template Name: Category Landing
 *
 * Reusable template for all sub-category pages (Destinations, Food, Wellness, etc.).
 * Queries posts from a WordPress category whose slug matches this page's slug.
 */

get_header();

$page_slug = get_post_field( 'post_name', get_queried_object_id() );
$paged     = max( 1, get_query_var( 'paged' ) );

$loop = new WP_Query( [
	'category_name'  => $page_slug,
	'posts_per_page' => 12,
	'paged'          => $paged,
] );
?>

<div class="page-hero">
	<div class="container">
		<p class="section-label"><?php echo esc_html( get_the_title() ); ?></p>
		<h1 class="page-hero__title"><?php the_title(); ?></h1>
	</div>
</div>

<div class="container section">
	<div class="content-sidebar-wrap">

		<main id="primary" role="main">
			<?php if ( $loop->have_posts() ) : ?>
			<div class="posts-grid">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<article class="post-card reveal">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-card__thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'shp-card', [ 'alt' => get_the_title() ] ); ?>
						</a>
					</div>
					<?php else : ?>
					<div class="post-card__thumb" style="background:var(--border);aspect-ratio:16/10;"></div>
					<?php endif; ?>

					<div class="post-card__meta">
						<?php
						$cats = get_the_category();
						if ( $cats ) :
						?>
						<a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>" class="post-card__cat"><?php echo esc_html( $cats[0]->name ); ?></a>
						<?php endif; ?>
						<span class="post-card__date"><?php echo get_the_date( 'd M Y' ); ?></span>
					</div>

					<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="post-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20, '&hellip;' ); ?></p>
					<a href="<?php the_permalink(); ?>" class="post-card__read-more"><?php echo shp_t( 'Đọc Thêm', 'Read More' ); ?></a>
				</article>
				<?php endwhile; ?>
			</div>

			<?php
			$big = 999999999;
			echo paginate_links( [
				'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'  => '?paged=%#%',
				'current' => $paged,
				'total'   => $loop->max_num_pages,
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
			] );
			wp_reset_postdata();
			?>

			<?php else : ?>
			<p style="color:var(--muted);padding:3rem 0;"><?php echo shp_t( 'Chưa có bài viết.', 'No posts yet.' ); ?></p>
			<?php endif; ?>
		</main>

		<aside id="sidebar">
			<?php get_sidebar(); ?>
		</aside>

	</div>
</div>

<?php get_footer(); ?>
