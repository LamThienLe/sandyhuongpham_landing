<?php
defined( 'ABSPATH' ) || exit;

/* ============================================================
   THEME SETUP
   ============================================================ */
function shp_setup() {
	load_theme_textdomain( 'shp', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form','comment-form','comment-list','gallery','caption','style','script' ] );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	// Elementor compatibility
	add_theme_support( 'elementor-hf' );
	add_theme_support( 'elementor' );

	// Post formats
	add_theme_support( 'post-formats', [ 'gallery', 'video', 'quote', 'link' ] );

	// Custom logo
	add_theme_support( 'custom-logo', [
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	] );

	// Nav menus
	register_nav_menus( [
		'primary-left'  => __( 'Primary Left', 'shp' ),
		'primary-right' => __( 'Primary Right', 'shp' ),
		'primary'       => __( 'Primary (Standard)', 'shp' ),
		'footer-links'  => __( 'Footer Quick Links', 'shp' ),
	] );

	// Image sizes
	add_image_size( 'shp-card',    800, 500, true );
	add_image_size( 'shp-wide',   1200, 700, true );
	add_image_size( 'shp-square',  600, 600, true );
	add_image_size( 'shp-hero',   1920, 1080, true );
}
add_action( 'after_setup_theme', 'shp_setup' );

/* ============================================================
   ENQUEUE SCRIPTS & STYLES
   ============================================================ */
function shp_enqueue() {
	// Google Fonts – Be Vietnam Pro
	wp_enqueue_style(
		'shp-google-fonts',
		'https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,200;0,300;0,400;0,500;0,600;1,200;1,300&display=swap',
		[],
		null
	);

	// Theme stylesheet
	wp_enqueue_style( 'shp-style', get_stylesheet_uri(), [ 'shp-google-fonts' ], '1.2.0' );

	// Main JS
	wp_enqueue_script(
		'shp-main',
		get_template_directory_uri() . '/assets/js/main.js',
		[],
		'1.2.0',
		true
	);

	// Pass AJAX URL and nonce to JS
	wp_localize_script( 'shp-main', 'shpData', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'shp_nonce' ),
	] );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shp_enqueue' );

/* ============================================================
   SIDEBARS
   ============================================================ */
function shp_register_sidebars() {
	$defaults = [
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	];

	register_sidebar( array_merge( $defaults, [
		'name' => __( 'Main Sidebar', 'shp' ),
		'id'   => 'sidebar-main',
		'description' => __( 'Appears on blog, archive, and search pages.', 'shp' ),
	] ) );

	register_sidebar( array_merge( $defaults, [
		'name' => __( 'Footer Sidebar', 'shp' ),
		'id'   => 'sidebar-footer',
		'description' => __( 'Footer widget area.', 'shp' ),
	] ) );
}
add_action( 'widgets_init', 'shp_register_sidebars' );

/* ============================================================
   CUSTOM NAV WALKER
   ============================================================ */
class SHP_Walker_Nav extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<ul class="sub-menu">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $id = 0 ) {
		$item    = $data_object;
		$classes = empty( $item->classes ) ? [] : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$has_children = in_array( 'menu-item-has-children', $classes );

		$class_names = implode( ' ', array_filter( array_map( 'trim', $classes ) ) );
		$output .= '<li class="' . esc_attr( $class_names ) . '">';

		$atts = [
			'href'   => $item->url,
			'title'  => $item->attr_title,
			'target' => $item->target,
			'rel'    => $item->xfn,
		];
		if ( $has_children ) {
			$atts['aria-haspopup'] = 'true';
			$atts['aria-expanded'] = 'false';
		}

		$attr_str = '';
		foreach ( $atts as $attr => $val ) {
			if ( ! empty( $val ) ) {
				$attr_str .= ' ' . $attr . '="' . esc_attr( $val ) . '"';
			}
		}

		$title  = apply_filters( 'the_title', $item->title, $item->ID );
		$output .= '<a' . $attr_str . '>' . $title;
		if ( $has_children && 0 === $depth ) {
			$output .= '<span class="dropdown-arrow" aria-hidden="true">&#x203A;</span>';
		}
		$output .= '</a>';
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}

/* ============================================================
   READ TIME HELPER
   ============================================================ */
function shp_post_read_time( $post_id = null ) {
	$post    = get_post( $post_id );
	$content = strip_tags( $post->post_content );
	$words   = str_word_count( $content );
	$minutes = max( 1, (int) ceil( $words / 200 ) );
	/* translators: %d: number of minutes */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'shp' ), $minutes );
}

/* ============================================================
   EXCERPT LENGTH
   ============================================================ */
add_filter( 'excerpt_length', fn() => 22 );
add_filter( 'excerpt_more',   fn() => '&hellip;' );

/* ============================================================
   CONNECT FORM HANDLER (AJAX)
   ============================================================ */
function shp_handle_connect_form() {
	check_ajax_referer( 'shp_nonce', 'nonce' );

	$name    = sanitize_text_field( $_POST['shp_name'] ?? '' );
	$email   = sanitize_email( $_POST['shp_email'] ?? '' );
	$message = sanitize_textarea_field( $_POST['shp_message'] ?? '' );

	if ( ! $name || ! is_email( $email ) || ! $message ) {
		wp_send_json_error( [ 'message' => __( 'Vui lòng điền đầy đủ thông tin.', 'shp' ) ] );
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf( '[SHP] Tin nhắn từ %s', $name );
	$body    = sprintf( "Tên: %s\nEmail: %s\n\nTin nhắn:\n%s", $name, $email, $message );
	$headers = [ 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email ];

	wp_mail( $to, $subject, $body, $headers );
	wp_send_json_success( [ 'message' => __( 'Cảm ơn! Sandy sẽ phản hồi bạn sớm.', 'shp' ) ] );
}
add_action( 'wp_ajax_shp_connect',        'shp_handle_connect_form' );
add_action( 'wp_ajax_nopriv_shp_connect', 'shp_handle_connect_form' );

/* ============================================================
   LANGUAGE SWITCHER
   ============================================================ */

/**
 * Persist the ?lang= param as a cookie so every subsequent page
 * already knows the chosen language — no plugin required.
 */
function shp_set_lang_cookie() {
	if ( isset( $_GET['lang'] ) && in_array( $_GET['lang'], [ 'vi', 'en' ], true ) ) {
		$lang = sanitize_key( $_GET['lang'] );
		setcookie( 'shp_lang', $lang, time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		$_COOKIE['shp_lang'] = $lang;
	}
}
add_action( 'init', 'shp_set_lang_cookie' );

/** Return current language: 'vi' (default) or 'en'. */
function shp_lang(): string {
	if ( isset( $_COOKIE['shp_lang'] ) && $_COOKIE['shp_lang'] === 'en' ) {
		return 'en';
	}
	return 'vi';
}

/**
 * Return the Vietnamese or English string depending on the active language.
 *
 * Usage: echo shp_t( 'Khám phá', 'Explore' );
 */
function shp_t( string $vi, string $en ): string {
	return shp_lang() === 'en' ? $en : $vi;
}

/** Build a URL that switches to $lang while preserving the current path. */
function shp_lang_url( string $lang ): string {
	$url = remove_query_arg( 'lang' );
	return add_query_arg( 'lang', $lang, $url );
}

/* ============================================================
   DEFAULT PAGES — auto-create on theme activation
   ============================================================ */

/**
 * Creates Blog and About pages and wires up WordPress Reading Settings
 * on theme activation. Safe to run on existing installs — never duplicates.
 */
function shp_create_default_pages() {
	// Blog / posts page
	$blog = get_page_by_path( 'blog' );
	if ( ! $blog ) {
		$blog_id = wp_insert_post( [
			'post_title'   => 'Blog',
			'post_name'    => 'blog',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		] );
		if ( $blog_id && ! is_wp_error( $blog_id ) ) {
			update_option( 'page_for_posts', $blog_id );
		}
	} else {
		update_option( 'page_for_posts', $blog->ID );
	}

	// Always enforce static front page mode
	update_option( 'show_on_front', 'page' );

	// Home page
	if ( ! get_option( 'page_on_front' ) ) {
		$home = get_page_by_path( 'home' );
		if ( ! $home ) {
			$home_id = wp_insert_post( [
				'post_title'  => 'Home',
				'post_name'   => 'home',
				'post_status' => 'publish',
				'post_type'   => 'page',
			] );
			if ( $home_id && ! is_wp_error( $home_id ) ) {
				update_option( 'page_on_front', $home_id );
			}
		} else {
			update_option( 'page_on_front', $home->ID );
		}
	}

	// About page
	$about = get_page_by_path( 'about' );
	if ( ! $about ) {
		wp_insert_post( [
			'post_title'  => 'About',
			'post_name'   => 'about',
			'post_status' => 'publish',
			'post_type'   => 'page',
		] );
	}
}
add_action( 'after_switch_theme', 'shp_create_default_pages' );

/**
 * Self-heals the Reading Settings on admin load.
 * Runs every admin request but is cheap — two option reads + early return.
 */
function shp_fix_reading_settings() {
	$blog = get_page_by_path( 'blog' );
	if ( ! $blog ) {
		return;
	}
	$pfp = (int) get_option( 'page_for_posts' );
	$pof = (int) get_option( 'page_on_front' );
	// Already correct: posts page is blog, front page is something else, mode is static
	if ( $pfp === $blog->ID && $pfp !== $pof && get_option( 'show_on_front' ) === 'page' ) {
		return;
	}
	update_option( 'show_on_front', 'page' );
	update_option( 'page_for_posts', $blog->ID );
}
add_action( 'admin_init', 'shp_fix_reading_settings' );

/* ============================================================
   BODY CLASSES
   ============================================================ */
function shp_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'is-front-page';
	}
	$template = get_page_template_slug();
	if ( $template ) {
		$classes[] = 'template-' . sanitize_html_class( str_replace( [ 'page-templates/', '.php' ], '', $template ) );
	}
	return $classes;
}
add_filter( 'body_class', 'shp_body_classes' );

/* ============================================================
   CATEGORY COLOR META
   ============================================================ */
function shp_category_color_meta() {
	add_meta_box(
		'shp_category_color',
		__( 'Category Color', 'shp' ),
		function( $tag ) {
			$color = get_term_meta( $tag->term_id, 'shp_color', true );
			echo '<label>' . __( 'Hex color:', 'shp' ) . ' <input type="text" name="shp_color" value="' . esc_attr( $color ) . '" /></label>';
		},
		'edit-category'
	);
}

/* ============================================================
   PREVENT XMLRPC BRUTEFORCE (LIGHT SECURITY)
   ============================================================ */
add_filter( 'xmlrpc_enabled', '__return_false' );

/* ============================================================
   ELEMENTOR HEADER/FOOTER SUPPORT
   ============================================================ */
function shp_elementor_support() {
	add_theme_support( 'elementor-hf' );
}
add_action( 'init', 'shp_elementor_support' );
