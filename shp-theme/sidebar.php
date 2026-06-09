<div class="sidebar-inner">

	<!-- Search -->
	<div class="widget widget-search">
		<h3 class="widget-title"><?php echo shp_t( 'Tìm Kiếm', 'Search' ); ?></h3>
		<form class="search-form" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<input type="search" name="s"
				placeholder="<?php echo esc_attr( shp_t( 'Tìm bài viết…', 'Search posts…' ) ); ?>"
				value="<?php echo esc_attr( get_search_query() ); ?>"
				aria-label="<?php echo esc_attr( shp_t( 'Tìm kiếm', 'Search' ) ); ?>">
			<button type="submit" aria-label="<?php echo esc_attr( shp_t( 'Tìm', 'Search' ) ); ?>">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
			</button>
		</form>
	</div>

	<!-- Categories -->
	<div class="widget widget-categories">
		<h3 class="widget-title"><?php echo shp_t( 'Danh Mục', 'Categories' ); ?></h3>
		<ul>
			<?php
			wp_list_categories( [
				'show_count'   => true,
				'title_li'     => '',
				'hierarchical' => true,
			] );
			?>
		</ul>
	</div>

	<!-- Recent Posts -->
	<div class="widget widget-recent">
		<h3 class="widget-title"><?php echo shp_t( 'Bài Viết Gần Đây', 'Recent Posts' ); ?></h3>
		<ul>
			<?php
			$recent = new WP_Query( [ 'posts_per_page' => 5 ] );
			while ( $recent->have_posts() ) : $recent->the_post();
			?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<span style="display:block;font-size:.72rem;color:var(--muted);margin-top:.15rem;"><?php echo get_the_date( 'd M Y' ); ?></span>
			</li>
			<?php endwhile; wp_reset_postdata(); ?>
		</ul>
	</div>

	<!-- Dynamic sidebars -->
	<?php if ( is_active_sidebar( 'sidebar-main' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-main' ); ?>
	<?php endif; ?>

</div>
