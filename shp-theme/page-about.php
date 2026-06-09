<?php
if ( have_posts() ) {
	the_post();
}
$has_custom_content = trim( get_the_content() ) !== '';

get_header();
?>

<!-- ============================================================
     PAGE HEADER
     ============================================================ -->
<div class="page-hero">
	<div class="container">
		<p class="section-label"><?php echo shp_t( 'Về Sandy', 'About' ); ?></p>
		<h1 class="page-hero__title">Sandy Huong Pham</h1>
	</div>
</div>


<!-- ============================================================
     INTRO — 2-col portrait strip
     ============================================================ -->
<!-- border-top omitted here: page-hero already has border-bottom -->
<section class="about-strip" style="border-top:none;">
	<div class="container">
		<div>
			<p class="about-strip__label"><?php echo shp_t( 'Xin Chào', 'Hello' ); ?></p>
			<h2 class="about-strip__title">
				<?php echo shp_t(
					'Tôi Là Sandy —<br>Người Đi Tìm Vẻ Đẹp<br>Của Cuộc Sống',
					'I\'m Sandy —<br>Chasing Beauty<br>Around The World'
				); ?>
			</h2>
			<p class="about-strip__text">
				<?php echo shp_t(
					'Chào bạn! Tôi là Sandy Huong Pham — travel blogger, người yêu cà phê và rượu vang, đang trên hành trình khám phá thế giới theo cách riêng của mình.',
					'Hi there! I\'m Sandy Huong Pham — travel blogger, coffee & wine lover, on a journey to explore the world my own way.'
				); ?>
			</p>
			<p class="about-strip__text">
				<?php echo shp_t(
					'SHP là nơi tôi ghi lại những điểm đến, văn hoá ẩm thực, bí quyết làm đẹp và câu chuyện cuộc sống — để truyền cảm hứng cho bạn sống đẹp hơn mỗi ngày.',
					'SHP is where I document destinations, food culture, beauty tips, and life stories — to inspire you to live more beautifully, every day.'
				); ?>
			</p>
			<a href="#sandy-story" class="btn btn--outline">
				<?php echo shp_t( 'Đọc Câu Chuyện Của Sandy', "Read Sandy's Story" ); ?>
			</a>
		</div>
		<div class="about-strip__image reveal">
			<img
				src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sandy-portrait.jpg' ); ?>"
				alt="Sandy Huong Pham"
				loading="lazy"
			>
		</div>
	</div>
</section>


<!-- ============================================================
     STORY — narrow editorial column
     ============================================================ -->
<section id="sandy-story" class="section">
	<div class="container--narrow">
		<p class="section-label"><?php echo shp_t( 'Câu Chuyện Của Sandy', "Sandy's Story" ); ?></p>
		<h2 class="section-title">
			<?php echo shp_t(
				'Mọi Hành Trình Bắt Đầu Từ Một Tách Cà Phê',
				'Every Journey Starts With A Cup Of Coffee'
			); ?>
		</h2>
		<p style="color:var(--muted);line-height:1.9;">
			<?php echo shp_t(
				'Tôi lớn lên với niềm đam mê bất tận với những chuyến đi và văn hoá ẩm thực. Từ những ngõ phố cà phê ở Hà Nội đến những vườn nho trải dài ở Tuscany, mỗi hành trình đều để lại trong tôi một dấu ấn không thể phai.',
				'I grew up with an endless passion for travel and food culture. From the coffee alleyways of Hanoi to the rolling vineyards of Tuscany, every journey has left an imprint I carry with me.'
			); ?>
		</p>
		<p style="color:var(--muted);line-height:1.9;">
			<?php echo shp_t(
				'Blog này ra đời từ mong muốn đơn giản: chia sẻ những gì tôi yêu thích — cách sống chậm lại, tận hưởng vẻ đẹp xung quanh, và tìm thấy niềm vui trong từng chi tiết nhỏ của cuộc sống.',
				'This blog was born from a simple desire: to share what I love — how to slow down, appreciate beauty around us, and find joy in the small details of life.'
			); ?>
		</p>
		<p style="color:var(--muted);line-height:1.9;">
			<?php echo shp_t(
				'Từ boutique hotel ở Đông Nam Á đến quán wine bar tucked away ở Paris — tôi đi, tôi viết, tôi chia sẻ. Không phải để flex, mà để cùng bạn tìm những góc đẹp mà cuộc đời này đang cất giấu.',
				'From boutique hotels across Southeast Asia to tucked-away wine bars in Paris — I go, I write, I share. Not to show off, but to find with you the beautiful corners this life keeps hidden.'
			); ?>
		</p>
	</div>
</section>


<!-- ============================================================
     PILLARS — what Sandy writes about
     ============================================================ -->
<section class="section section--sm" style="border-top:1px solid var(--border);">
	<div class="container">
		<div class="section-header reveal">
			<p class="section-label"><?php echo shp_t( 'Nội Dung', 'What I Write About' ); ?></p>
			<h2 class="section-title"><?php echo shp_t( 'Những Chủ Đề Tôi Yêu Thích', 'Topics Close To My Heart' ); ?></h2>
		</div>
		<div class="grid-3">
			<?php
			$pillars = [
				[
					'label' => shp_t( 'Du Lịch', 'Travel' ),
					'title' => shp_t( 'Khám Phá Thế Giới', 'Exploring The World' ),
					'text'  => shp_t(
						'Từ điểm đến châu Á đến châu Âu — đánh giá khách sạn, gợi ý lịch trình và những góc ảnh đẹp không ai biết.',
						'From Asia to Europe — hotel reviews, itineraries, and hidden corners worth the detour.'
					),
				],
				[
					'label' => shp_t( 'Cà Phê & Rượu Vang', 'Coffee & Wine' ),
					'title' => shp_t( 'Thưởng Thức Tinh Tế', 'The Art Of Savouring' ),
					'text'  => shp_t(
						'Những quán cà phê đặc biệt, chai vang đáng nhớ và những buổi chiều không vội vàng.',
						'Specialty cafés, memorable wine bottles, and unhurried afternoons worth slowing down for.'
					),
				],
				[
					'label' => shp_t( 'Làm Đẹp & Đời Sống', 'Beauty & Lifestyle' ),
					'title' => shp_t( 'Sống Đẹp Mỗi Ngày', 'Living Beautifully' ),
					'text'  => shp_t(
						'Skincare, wellness và những thói quen nhỏ giúp cuộc sống hằng ngày trở nên ý nghĩa hơn.',
						'Skincare, wellness, and small habits that make everyday life feel more intentional.'
					),
				],
			];
			foreach ( $pillars as $pillar ) :
			?>
			<div class="about-pillar reveal">
				<p class="about-pillar__label"><?php echo esc_html( $pillar['label'] ); ?></p>
				<h3 class="about-pillar__title"><?php echo esc_html( $pillar['title'] ); ?></h3>
				<p class="about-pillar__text"><?php echo esc_html( $pillar['text'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>


<?php if ( $has_custom_content ) : ?>
<!-- ============================================================
     CUSTOM / ELEMENTOR CONTENT
     ============================================================ -->
<div class="container section">
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</div>
<?php endif; ?>


<?php get_footer(); ?>
