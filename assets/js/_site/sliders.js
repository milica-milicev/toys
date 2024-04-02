import Swiper from "swiper/bundle";

("use strict");
const Sliders = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		var isolatedGalleryThumbs = new Swiper(".isolated-product__gallery-thumbs", {
			slidesPerView: 3,
			spaceBetween: 10,
			// direction: 'vertical',
			breakpoints: {
				767: {
					slidesPerView: 4,
					spaceBetween: 20,
				},
			},
		});

		var isolatedProductMain = new Swiper(".isolated-product__main", {
			watchOverflow: true,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			preventInteractionOnTransition: true,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			effect: 'fade',
				fadeEffect: {
				crossFade: true
			},
			thumbs: {
				swiper: isolatedGalleryThumbs
			}
		});

		isolatedProductMain.on('slideChangeTransitionStart', function() {
			isolatedGalleryThumbs.slideTo(isolatedProductMain.activeIndex);
		});

		isolatedGalleryThumbs.on('transitionStart', function(){
			isolatedProductMain.slideTo(isolatedGalleryThumbs.activeIndex);
		});
		
		var testimonials = new Swiper('.js-swiper-testimonials', {
			slidesPerView: 1,
			spaceBetween: 10,
			pagination: {
			el: ".swiper-pagination",
			clickable: true,
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			breakpoints: {
				767: {
					slidesPerView: 2,
					spaceBetween: 10,
				},
				1025: {
					slidesPerView: 3,
					spaceBetween: 20,
				},
			},
		});



		var productThumbs = new Swiper(".js-product-thumbs", {
			slidesPerView: 3,
			spaceBetween: 10,
			// direction: 'vertical',
			breakpoints: {
				767: {
					slidesPerView: 4,
					spaceBetween: 20,
				},
			},
		});

		var productMain = new Swiper(".js-product-main", {
			watchOverflow: true,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			preventInteractionOnTransition: true,
			navigation: {
				nextEl: '.js-product-main-next-btn',
				prevEl: '.js-product-main-prev-btn',
			},
			effect: 'fade',
				fadeEffect: {
				crossFade: true
			},
			thumbs: {
				swiper: productThumbs
			}
		});

		productMain.on('slideChangeTransitionStart', function() {
			productThumbs.slideTo(productMain.activeIndex);
		});

		productThumbs.on('transitionStart', function(){
			productMain.slideTo(productThumbs.activeIndex);
		});

		var galleryTop = new Swiper('.gallery-top', {
			spaceBetween: 10,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			on: {
				init: function () {
					// Postavite početni slajd, modal i ostale potrebne stvari kada se Swiper inicijalizuje
				}
			}
		});

		document.querySelector('.js-product-main').addEventListener('click', function(e) {
            e.preventDefault(); // Sprečava defaultno ponašanje ako je potrebno
            var clickedSlideIndex = productMain.activeIndex; // Dobiće indeks trenutno aktivnog slajda
            // Ovde prenesite slike iz glavnog Swipera u Swiper unutar modalnog prozora
            // Možete to uraditi kopiranjem HTML-a slajdova ili prenosom putanja slika i kreiranjem novih slajdova
            galleryTop.update(); // Osvežite Swiper u modalnom prozoru
            galleryTop.slideTo(clickedSlideIndex, 0); // Pređite na slajd koji je bio aktivan
           // document.getElementById('galleryModal').style.display = 'block'; // Prikažite modalni prozor
			document.getElementById('galleryModal').classList.add('visible');
        });
		


	}
};

export default Sliders;
