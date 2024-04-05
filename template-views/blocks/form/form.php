<div class="form" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/_demo/contact-banner.jpg');">
	<div class="form-box">
		<div class="form-box__left">
			<div class="section-head">
				<h1 class="section-head__title section-head__title--white">Kontaktirajte nas</h1>
				<p class="section-head__subtitle section-head__subtitle--white">Igračke možete naručuti preko shop-a, a za sve informacije, sugestije i primedbe možete nam pisati ovde:</p>
			</div>

			<?php echo do_shortcode( '[contact-form-7 id="d48bdc1" title="Contact form 1"]' );?>
			<!-- <form action="action_page.php">
				<input type="text" id="name" name="name" placeholder="Ime i prezime*">
				<input type="email" id="email" name="email" placeholder="Email*">
				<textarea id="subject" name="subject" placeholder="Poruka*" style="height:133px"></textarea>
				<div class="form-box__btn">
					<input class="btn btn--white" type="submit" value="Pošaljite">
				</div>
			</form> -->
		</div>
		<div class="form-box__right">
			<div class="form-box__right-phone">
				<div class="form-box__right-phone-icon">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/_demo/phone.svg" alt="">
				</div>
				<div class="form-box__right-phone-number">
					<a href="tel:0603214261">060 321 42 61</a>
					<a href="tel:0605474482">060 547 44 82</a>
				</div>
			</div>
			<div class="form-box__right-email">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/_demo/mail.svg" alt="">
				<a href="mailto:podrska@svetigranja.rs">podrska@svetigranja.rs</a>
			</div>
			<div class="form-box__right-media">
				<a class="form-box__right-media-instagram" href="javascript:;"></a>
				<a class="form-box__right-media-facebook" href="javascript:;"></a>
				<a class="form-box__right-media-tik-tok" href="javascript:;"></a>
			</div>
		</div>
	</div>
</div>