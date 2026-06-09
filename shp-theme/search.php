<?php get_header(); ?>

<div class="archive-header">
	<div class="container">
		<p class="section-label">Kết Quả</p>
		<h1 class="archive-title">
			<?php
			printf(
				/* translators: %s: search query */
				esc_html__( 'Tìm kiếm: "%s"', 'shp' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>
	</div>
</div>

<div class="container section">
	<div class="content-sidebar-wrap">

		<main id="primary" role="main">
			<?php if ( have_posts() ) : ?>
			<p class="search-results-count">
				<?php
				global $wp_query;
				printf(
					/* translators: %d: number of results */
					esc_html( _n( 'Tìm thấy %d kết quả.', 'Tìm thấy %d kết quả.', $wp_query->found_posts, 'shp' ) ),
					esc_html( number_format_i18n( $wp_query->found_posts ) )
				);
				?>
			</p>

			<div class="posts-grid">
				<?php while ( have_posts() ) : the_post(); ?>
				<article class="post-card reveal">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-card__thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'shp-card', [ 'alt' => get_the_title() ] ); ?>
						</a>
					</div>
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
					<a href="<?php the_permalink(); ?>" class="post-card__read-more">Đọc Thêm</a>
				</article>
				<?php endwhile; ?>
			</div>

			<?php the_posts_pagination( [ 'prev_text' => '&larr;', 'next_text' => '&rarr;' ] ); ?>

			<?php else : ?>
			<div class="search-page" style="text-align:left;padding-top:2rem;">
				<p style="color:var(--muted);">Không tìm thấy kết quả nào cho "<strong><?php echo esc_html( get_search_query() ); ?></strong>". Thử tìm từ khóa khác.</p>
				<?php get_search_form(); ?>
			</div>
			<?php endif; ?>
		</main>

		<aside id="sidebar">
			<?php get_sidebar(); ?>
		</aside>

	</div>
</div>

<?php get_footer(); ?>
