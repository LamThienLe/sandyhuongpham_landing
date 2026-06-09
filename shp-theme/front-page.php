<?php get_header(); ?>

<!-- ============================================================
     HERO
     ============================================================ -->
<section class="hero" aria-label="<?php echo esc_attr( shp_t( 'Trang chủ', 'Homepage' ) ); ?>">
	<div class="hero__bg" style="background-image:url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-bg.jpg' ); ?>');" role="img" aria-label="Hero background"></div>
	<div class="hero__content reveal">
		<p class="hero__eyebrow">Sandy Huong Pham</p>
		<h1 class="hero__title">
			<?php echo shp_t( 'Sống đẹp,<br>Đi khắp thế gian', 'Live beautifully,<br>travel the world' ); ?>
		</h1>
		<p class="hero__sub">
			<?php echo shp_t(
				'Hành trình khám phá vẻ đẹp của cuộc sống — từ những cung đường xuyên châu lục đến góc cà phê thân quen.',
				'A journey discovering the beauty of life — from cross-continental roads to your favourite corner café.'
			); ?>
		</p>
		<div class="hero__ctas">
			<a href="<?php echo esc_url( shp_blog_url() ); ?>" class="btn btn--dark">
				<?php echo shp_t( 'Khám Phá Blog', 'Explore the Blog' ); ?>
			</a>
			<a href="#connect" class="btn btn--outline">
				<?php echo shp_t( 'Kết Nối Với Sandy', 'Connect with Sandy' ); ?>
			</a>
		</div>
	</div>
</section>


<!-- ============================================================
     CATEGORY GRID
     ============================================================ -->
<section class="section section--sm" style="padding-top:0;">
	<div class="section-header" style="padding-top:clamp(3rem,5vw,5rem);">
		<p class="section-label"><?php echo shp_t( 'Khám Phá', 'Explore' ); ?></p>
		<h2 class="section-title"><?php echo shp_t( 'Nội Dung Nổi Bật', 'Featured Content' ); ?></h2>
	</div>

	<div class="category-grid">
		<?php
		$cats = [
			[
				'label' => shp_t( 'Du Lịch', 'Travel' ),
				'title' => shp_t( 'Du Lịch', 'Travel' ),
				'desc'  => shp_t( 'Điểm đến · Khách sạn · Ẩm thực', 'Destinations · Hotels · Food' ),
				'slug'  => 'du-lich',
				'img'   => get_template_directory_uri() . '/assets/images/cat-travel.jpg',
			],
			[
				'label' => 'Lifestyle',
				'title' => 'Lifestyle',
				'desc'  => shp_t( 'Sức khoẻ · Làm đẹp · Cuộc sống', 'Wellness · Beauty · Life' ),
				'slug'  => 'lifestyle',
				'img'   => get_template_directory_uri() . '/assets/images/cat-lifestyle.jpg',
			],
			[
				'label' => shp_t( 'Cà Phê & Rượu Vang', 'Coffee & Wine' ),
				'title' => shp_t( 'Cà Phê & Rượu Vang', 'Coffee & Wine' ),
				'desc'  => shp_t( 'Quán ngon · Vang đặc biệt', 'Great cafés · Fine wines' ),
				'slug'  => 'coffee-wine',
				'img'   => get_template_directory_uri() . '/assets/images/cat-coffee.jpg',
			],
			[
				'label' => shp_t( 'Làm Đẹp', 'Beauty' ),
				'title' => shp_t( 'Làm Đẹp', 'Beauty' ),
				'desc'  => shp_t( 'Skincare · Makeup · Review', 'Skincare · Makeup · Reviews' ),
				'slug'  => 'lam-dep',
				'img'   => get_template_directory_uri() . '/assets/images/cat-beauty.jpg',
			],
		];

		foreach ( $cats as $cat ) :
			$term_link = get_term_link( $cat['slug'], 'category' );
			$link = is_wp_error( $term_link ) ? home_url( '/' ) : $term_link;
		?>
		<article class="cat-card">
			<img class="cat-card__img" src="<?php echo esc_url( $cat['img'] ); ?>" alt="<?php echo esc_attr( $cat['title'] ); ?>" loading="lazy">
			<div class="cat-card__body">
				<p class="cat-card__label"><?php echo esc_html( $cat['desc'] ); ?></p>
				<h3 class="cat-card__title"><a href="<?php echo esc_url( $link ); ?>" style="color:inherit;"><?php echo esc_html( $cat['title'] ); ?></a></h3>
			</div>
		</article>
		<?php endforeach; ?>
	</div>
</section>


<!-- ============================================================
     RECENT POSTS (3-col)
     ============================================================ -->
<section class="section">
	<div class="container">
		<div class="section-header reveal">
			<p class="section-label"><?php echo shp_t( 'Bài Viết Mới Nhất', 'Latest Posts' ); ?></p>
			<h2 class="section-title"><?php echo shp_t( 'Từ Nhật Ký Của Sandy', "From Sandy's Journal" ); ?></h2>
		</div>

		<?php
		$recent = new WP_Query( [
			'posts_per_page' => 3,
			'post_status'    => 'publish',
		] );
		?>

		<?php if ( $recent->have_posts() ) : ?>
		<div class="grid-3">
			<?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
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
					$post_cats = get_the_category();
					if ( $post_cats ) :
					?>
					<a href="<?php echo esc_url( get_category_link( $post_cats[0]->term_id ) ); ?>" class="post-card__cat"><?php echo esc_html( $post_cats[0]->name ); ?></a>
					<?php endif; ?>
					<span class="post-card__date"><?php echo get_the_date( 'd M Y' ); ?></span>
				</div>

				<h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="post-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18, '&hellip;' ); ?></p>
				<a href="<?php the_permalink(); ?>" class="post-card__read-more">
					<?php echo shp_t( 'Đọc Thêm', 'Read More' ); ?>
				</a>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<div class="text-center" style="margin-top:3rem;">
			<a href="<?php echo esc_url( shp_blog_url() ); ?>" class="btn btn--outline">
				<?php echo shp_t( 'Xem Tất Cả Bài Viết', 'View All Posts' ); ?>
			</a>
		</div>

		<?php else : ?>
		<p class="text-center text-muted"><?php echo shp_t( 'Chưa có bài viết nào.', 'No posts yet.' ); ?></p>
		<?php endif; ?>
	</div>
</section>


<!-- ============================================================
     ABOUT STRIP (white bg, 2-col)
     ============================================================ -->
<section class="about-strip">
	<div class="container">
		<div>
			<p class="about-strip__label"><?php echo shp_t( 'Về Sandy', 'About Sandy' ); ?></p>
			<h2 class="about-strip__title">
				<?php echo shp_t(
					'Tôi Là Sandy —<br>Người Đi Tìm Vẻ Đẹp<br>Của Cuộc Sống',
					'I\'m Sandy —<br>Chasing Beauty<br>Around The World'
				); ?>
			</h2>
			<p class="about-strip__text">
				<?php echo shp_t(
					'Chào bạn! Tôi là Sandy Huong Pham — travel blogger, người yêu cà phê và rượu vang, đang trên hành trình khám phá thế giới theo cách riêng của mình. SHP là nơi tôi ghi lại những điểm đến, văn hoá ẩm thực, bí quyết làm đẹp và câu chuyện cuộc sống.',
					'Hi there! I\'m Sandy Huong Pham — travel blogger, coffee & wine lover, on a journey to explore the world my own way. SHP is where I document destinations, food culture, beauty tips, and life stories.'
				); ?>
			</p>
			<p class="about-strip__text">
				<?php echo shp_t(
					'Từ những khách sạn boutique ở châu Á đến các vineyard ở châu Âu, tôi tin rằng mỗi chuyến đi là một bài học — và mỗi tách cà phê là một cuộc trò chuyện mới.',
					'From boutique hotels across Asia to vineyards in Europe, I believe every trip is a lesson — and every cup of coffee is a new conversation.'
				); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn btn--outline">
				<?php echo shp_t( 'Đọc Câu Chuyện Của Sandy', "Read Sandy's Story" ); ?>
			</a>
		</div>
		<div class="about-strip__image reveal">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sandy-portrait.jpg' ); ?>" alt="Sandy Huong Pham" loading="lazy">
		</div>
	</div>
</section>


<?php get_footer(); ?>
