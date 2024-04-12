'use strict';
const BackToTop = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		// Dohvatanje dugmeta
		const backToTopBtn = document.querySelector('.js-back-to-top-btn');

		// Dodavanje event listenera za scroll
		window.onscroll = function() {
			scrollFunction();
		};

		function scrollFunction() {
			// Ako je korisnik skrolovao 20px od vrha stranice, pokažite dugme
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				backToTopBtn.classList.add('is-visible');
			} else {
				backToTopBtn.classList.remove('is-visible');
			}
		}

		// Implementacija funkcije za smooth povratak na vrh
		backToTopBtn.onclick = function() {
			window.scrollTo({
				top: 0,
				behavior: 'smooth'
			});
		}
	}
};

export default BackToTop;
