<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="sr-only" href="#main-content"><?php esc_html_e( 'Skip to content', 'shp' ); ?></a>

<?php
$is_front = is_front_page();
$template = get_page_template_slug();
$is_blank = ( 'page-templates/template-blank.php' === $template );

if ( $is_blank ) {
	return; // Blank template outputs no header
}

$lang     = shp_lang();
$vi_url   = esc_url( shp_lang_url( 'vi' ) );
$en_url   = esc_url( shp_lang_url( 'en' ) );
$vi_class = $lang === 'vi' ? ' is-active' : '';
$en_class = $lang === 'en' ? ' is-active' : '';

// Language switcher HTML — reused in both header variants
$lang_switch = '<div class="lang-switch" aria-label="Language">'
	. '<a href="' . $vi_url . '" class="' . trim( 'lang-vi' . $vi_class ) . '" lang="vi" hreflang="vi">VI</a>'
	. '<span class="lang-switch__sep" aria-hidden="true">·</span>'
	. '<a href="' . $en_url . '" class="' . trim( 'lang-en' . $en_class ) . '" lang="en" hreflang="en">EN</a>'
	. '</div>';
?>

<header id="site-header" class="<?php echo $is_front ? 'header--front' : 'header--standard'; ?>">

<?php if ( $is_front ) : ?>
	<!-- ===== HOMEPAGE 3-COL SPLIT HEADER ===== -->
	<div class="header-inner--split">

		<nav class="nav-left primary-nav" aria-label="<?php esc_attr_e( 'Left menu', 'shp' ); ?>">
			<?php
			if ( has_nav_menu( 'primary-left' ) ) {
				wp_nav_menu( [
					'theme_location' => 'primary-left',
					'container'      => false,
					'walker'         => new SHP_Walker_Nav(),
				] );
			} else {
				shp_fallback_nav_left();
			}
			?>
		</nav>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
			<span class="site-logo__name">SHP</span>
			<span class="site-logo__sub">Travel &amp; Lifestyle</span>
		</a>

		<div class="nav-right" style="display:flex;align-items:center;">
			<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Right menu', 'shp' ); ?>">
				<?php
				if ( has_nav_menu( 'primary-right' ) ) {
					wp_nav_menu( [
						'theme_location' => 'primary-right',
						'container'      => false,
						'walker'         => new SHP_Walker_Nav(),
					] );
				} else {
					shp_fallback_nav_right();
				}
				?>
			</nav>
			<?php echo $lang_switch; ?>
		</div>

		<button class="menu-toggle" aria-controls="mobile-nav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'shp' ); ?>">
			<span></span><span></span><span></span>
		</button>

	</div><!-- .header-inner--split -->

<?php else : ?>
	<!-- ===== STANDARD HEADER — uses the SAME primary-left + primary-right menus
	     as the homepage so navigation is consistent on every page.
	     To change: WP Admin → Appearance → Menus → assign menus to
	     "Primary Left" and "Primary Right" locations.             ===== -->
	<div class="header-inner--standard">

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
			<span class="site-logo__name">SHP</span>
			<span class="site-logo__sub">Travel &amp; Lifestyle</span>
		</a>

		<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Main navigation', 'shp' ); ?>">
			<?php
			// Left items
			if ( has_nav_menu( 'primary-left' ) ) {
				wp_nav_menu( [
					'theme_location' => 'primary-left',
					'container'      => false,
					'walker'         => new SHP_Walker_Nav(),
				] );
			} else {
				shp_fallback_nav_left();
			}
			// Right items — appended in the same nav row
			if ( has_nav_menu( 'primary-right' ) ) {
				wp_nav_menu( [
					'theme_location' => 'primary-right',
					'container'      => false,
					'walker'         => new SHP_Walker_Nav(),
				] );
			} else {
				shp_fallback_nav_right();
			}
			?>
		</nav>

		<?php echo $lang_switch; ?>

		<button class="menu-toggle" aria-controls="mobile-nav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'shp' ); ?>">
			<span></span><span></span><span></span>
		</button>

	</div><!-- .header-inner--standard -->

<?php endif; ?>

</header><!-- #site-header -->

<div id="mobile-nav" aria-hidden="true" aria-label="<?php esc_attr_e( 'Mobile navigation', 'shp' ); ?>">
	<nav>
		<?php
		if ( has_nav_menu( 'primary-left' ) ) {
			wp_nav_menu( [
				'theme_location' => 'primary-left',
				'container'      => false,
				'walker'         => new SHP_Walker_Nav(),
			] );
		} else {
			shp_fallback_nav_left();
		}
		if ( has_nav_menu( 'primary-right' ) ) {
			wp_nav_menu( [
				'theme_location' => 'primary-right',
				'container'      => false,
				'walker'         => new SHP_Walker_Nav(),
			] );
		} else {
			shp_fallback_nav_right();
		}
		?>
	</nav>
	<?php echo $lang_switch; ?>
</div>

<div id="main-content">

<?php
/* ============================================================
   FALLBACK NAV FUNCTIONS
   These render when no WP menu has been assigned to the location.
   They use shp_t() so they respect the active language.
   ============================================================ */
function shp_fallback_nav_left() {
	echo '<ul>';
	echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">' . shp_t( 'Giới Thiệu', 'About' ) . '</a></li>';
	echo '<li class="menu-item-has-children"><a href="#">' . shp_t( 'Du Lịch', 'Travel' ) . '</a><ul class="sub-menu">';
	echo '<li><a href="#">' . shp_t( 'Điểm Du Lịch', 'Destinations' ) . '</a></li>';
	echo '<li><a href="#">' . shp_t( 'Review Hotel / Resort', 'Hotel Reviews' ) . '</a></li>';
	echo '<li><a href="#">' . shp_t( 'Ẩm Thực', 'Food' ) . '</a></li>';
	echo '</ul></li>';
	echo '<li class="menu-item-has-children"><a href="#">Lifestyle</a><ul class="sub-menu">';
	echo '<li><a href="#">' . shp_t( 'Sức Khoẻ', 'Wellness' ) . '</a></li>';
	echo '<li><a href="#">' . shp_t( 'Làm Đẹp', 'Beauty' ) . '</a></li>';
	echo '<li><a href="#">' . shp_t( 'Tình Yêu & Các Mối Quan Hệ', 'Love & Relationships' ) . '</a></li>';
	echo '<li><a href="#">' . shp_t( 'Kinh Doanh', 'Business' ) . '</a></li>';
	echo '</ul></li>';
	echo '</ul>';
}

function shp_fallback_nav_right() {
	echo '<ul>';
	echo '<li class="menu-item-has-children"><a href="#">' . shp_t( 'Cà Phê & Rượu Vang', 'Coffee & Wine' ) . '</a><ul class="sub-menu">';
	echo '<li><a href="#">Coffee</a></li>';
	echo '<li><a href="#">' . shp_t( 'Quán', 'Cafés' ) . '</a></li>';
	echo '<li><a href="#">' . shp_t( 'Rượu Vang', 'Wine' ) . '</a></li>';
	echo '</ul></li>';
	echo '<li><a href="' . esc_url( shp_blog_url() ) . '">Blog</a></li>';
	echo '</ul>';
}

/** Returns the URL of the WordPress posts page (Blog). */
function shp_blog_url(): string {
	$pid = (int) get_option( 'page_for_posts' );
	if ( $pid ) {
		$page = get_post( $pid );
		// get_permalink() can return home_url for the posts page; build from slug instead
		if ( $page && 'publish' === $page->post_status && $page->post_name ) {
			return home_url( '/' . $page->post_name . '/' );
		}
	}
	return home_url( '/blog/' );
}
