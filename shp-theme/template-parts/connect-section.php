<section class="connect-section" id="connect">
	<div class="container--narrow">
		<p class="section-label text-center"><?php echo shp_t( 'Kết Nối', 'Connect' ); ?></p>
		<h2 class="section-title text-center" style="font-size:clamp(1.6rem,3vw,2.6rem);margin-bottom:.5rem;">
			<?php echo shp_t( 'KẾT NỐI VỚI SANDY', 'GET IN TOUCH WITH SANDY' ); ?>
		</h2>
		<p style="color:var(--muted);font-size:.88rem;text-align:center;margin-bottom:0;">
			<?php echo shp_t(
				'Chia sẻ câu chuyện của bạn hoặc chỉ đơn giản là nói xin chào.',
				'Share your story or simply say hello.'
			); ?>
		</p>

		<form class="connect-form" id="shp-connect-form" novalidate>
			<?php wp_nonce_field( 'shp_nonce', 'shp_nonce_field' ); ?>

			<div class="connect-form__row">
				<div class="form-field">
					<label for="shp_name"><?php echo shp_t( 'Họ Tên', 'Full Name' ); ?></label>
					<input type="text" id="shp_name" name="shp_name"
						placeholder="<?php echo esc_attr( shp_t( 'Tên của bạn', 'Your name' ) ); ?>"
						required autocomplete="name">
				</div>
				<div class="form-field">
					<label for="shp_email">Email</label>
					<input type="email" id="shp_email" name="shp_email"
						placeholder="email@example.com"
						required autocomplete="email">
				</div>
			</div>

			<div class="form-field">
				<label for="shp_message"><?php echo shp_t( 'Tin nhắn', 'Message' ); ?></label>
				<textarea id="shp_message" name="shp_message"
					placeholder="<?php echo esc_attr( shp_t( 'Viết gì đó cho Sandy…', 'Write something for Sandy…' ) ); ?>"
					required></textarea>
			</div>

			<div class="connect-form__submit">
				<button type="submit" class="btn btn--dark">
					<?php echo shp_t( 'GỬI', 'SEND' ); ?>
				</button>
				<p class="connect-form__feedback" aria-live="polite" style="margin-top:.75rem;font-size:.8rem;color:var(--accent);min-height:1.2em;"></p>
			</div>
		</form>
	</div>
</section>
