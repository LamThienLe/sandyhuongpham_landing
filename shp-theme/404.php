<?php get_header(); ?>

<div class="container">
	<div class="error-page">
		<p class="error-code">404</p>
		<h1 class="error-title">
			<?php echo shp_t( 'Trang Không Tồn Tại', 'Page Not Found' ); ?>
		</h1>
		<p class="error-text">
			<?php echo shp_t(
				'Trang bạn đang tìm kiếm đã bị xóa, đổi tên hoặc tạm thời không khả dụng.',
				'The page you are looking for has been removed, renamed, or is temporarily unavailable.'
			); ?>
		</p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--outline">
			<?php echo shp_t( 'Về Trang Chủ', 'Back to Home' ); ?>
		</a>
	</div>
</div>

<?php get_footer(); ?>
