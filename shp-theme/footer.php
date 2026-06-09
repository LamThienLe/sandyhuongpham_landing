<?php
$template = get_page_template_slug();
$is_blank = ( 'page-templates/template-blank.php' === $template );
if ( $is_blank ) {
	wp_footer();
	echo '</body></html>';
	return;
}
?>

</div><!-- #main-content -->

<?php get_template_part( 'template-parts/connect-section' ); ?>

<!-- ===== FOOTER ===== -->
<footer id="site-footer" role="contentinfo">

	<!-- Social bar -->
	<div class="footer-social">
		<span class="footer-social__label"><?php echo shp_t( 'Kết nối', 'Stay Connected' ); ?></span>
		<ul class="footer-social__links">
			<li>
				<a href="#" aria-label="Facebook" rel="noopener noreferrer" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
					FB
				</a>
			</li>
			<li>
				<a href="#" aria-label="Instagram" rel="noopener noreferrer" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
					IG
				</a>
			</li>
			<li>
				<a href="#" aria-label="X (Twitter)" rel="noopener noreferrer" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
					X
				</a>
			</li>
			<li>
				<a href="#" aria-label="TikTok" rel="noopener noreferrer" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.32 6.32 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.77a4.85 4.85 0 01-1.01-.08z"/></svg>
					TK
				</a>
			</li>
		</ul>
	</div>

	<!-- Quick links bar -->
	<ul class="footer-links">
		<?php
		if ( has_nav_menu( 'footer-links' ) ) {
			wp_nav_menu( [
				'theme_location' => 'footer-links',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'walker'         => new SHP_Walker_Nav(),
			] );
		} else {
			$links = [
				shp_t( 'Khách Sạn & Resort', 'Hotels & Resorts' ) => '#',
				'Coffee'                                            => '#',
				shp_t( 'Rượu Vang', 'Wine' )                       => '#',
				shp_t( 'Làm Đẹp', 'Beauty' )                       => '#',
				shp_t( 'Đời Sống', 'Lifestyle' )                   => '#',
				'Blog'                                              => shp_blog_url(),
			];
			foreach ( $links as $label => $url ) {
				echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
			}
		}
		?>
	</ul>

	<!-- Copyright -->
	<div class="footer-copyright">
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Sandy Huong Pham &mdash;
		<?php echo shp_t( 'Bảo lưu mọi quyền.', 'All rights reserved.' ); ?>
		</p>
	</div>

</footer><!-- #site-footer -->

<?php wp_footer(); ?>
</body>
</html>
