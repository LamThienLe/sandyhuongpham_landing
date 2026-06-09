<div class="search-page" style="text-align:center;padding:4rem 0;">
	<h2 class="error-title" style="font-size:1.5rem;">Không Tìm Thấy Nội Dung</h2>
	<p class="error-text">Có vẻ như chưa có bài viết nào ở đây. Hãy thử tìm kiếm hoặc khám phá các danh mục khác.</p>
	<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) {
		printf(
			'<a href="%s" class="btn btn--outline">%s</a>',
			esc_url( admin_url( 'post-new.php' ) ),
			esc_html__( 'Viết Bài Đầu Tiên', 'shp' )
		);
	} else {
		get_search_form();
	}
	?>
</div>
