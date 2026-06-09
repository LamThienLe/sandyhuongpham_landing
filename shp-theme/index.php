<?php get_header(); ?>

<div class="archive-header">
	<div class="container">
		<p class="section-label">Blog</p>
		<h1 class="archive-title">Tất Cả Bài Viết</h1>
	</div>
</div>

<div class="container section">
	<div class="content-sidebar-wrap">

		<main id="primary" role="main">
			<?php if ( have_posts() ) : ?>
			<div class="posts-grid">
				<?php while ( have_posts() ) : the_post(); ?>
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
						<span class="post-card__date"><?php echo esc_html( shp_post_read_time() ); ?></span>
					</div>

					<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="post-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20, '&hellip;' ); ?></p>
					<a href="<?php the_permalink(); ?>" class="post-card__read-more">Đọc Thêm</a>
				</article>
				<?php endwhile; ?>
			</div>

			<?php
			the_posts_pagination( [
				'mid_size'  => 2,
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
				'before_page_number' => '<span class="sr-only">' . __( 'Page', 'shp' ) . ' </span>',
			] );
			?>

			<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</main>

		<aside id="sidebar">
			<?php get_sidebar(); ?>
		</aside>

	</div>
</div>

<?php get_footer(); ?>
