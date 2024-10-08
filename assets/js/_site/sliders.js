import Swiper from "swiper/bundle";

("use strict");
const Sliders = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		var isolatedGalleryThumbs = new Swiper(".js-isolated-product-gallery-thumbs", {
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

		var isolatedProductMain = new Swiper(".js-isolated-product-main", {
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

		// Custom fancybox - Product gallery slider in modal window
		const productGallery = document.querySelector('.js-product-gallery');
		const productGalleryImg = document.querySelector('.js-gallery-main-img');
		const productMainSlider = document.querySelector('.js-product-main');
		const galleryModalSliderSel = document.querySelector('.js-product-gallery-modal');
		const modalCloseBtn = document.querySelector('.js-product-gallery-modal-close-btn');

		var galleryModalSlider = new Swiper('.js-product-gallery-modal-slider', {
			spaceBetween: 10,
			navigation: {
				nextEl: '.js-product-modal-next-btn',
				prevEl: '.js-product-modal-prev-btn',
			}
		});

		if (productGallery) {
			if (productMainSlider) {
				productMainSlider.addEventListener('click', function(e) {
					e.preventDefault();
					var clickedSlideIndex = productMain.activeIndex;
					galleryModalSlider.update();
					galleryModalSlider.slideTo(clickedSlideIndex, 0);
					galleryModalSliderSel.classList.add('is-visible');
				});
			} else {
				productGalleryImg.addEventListener('click', function(e) {
					e.preventDefault();
					galleryModalSliderSel.classList.add('is-visible');
				});
			}
		
			modalCloseBtn.addEventListener('click', function() {
				galleryModalSliderSel.classList.remove('is-visible');
			});
			
			// Dodajte event listener na document za osluškivanje keydown događaja
			document.addEventListener('keydown', function(event) {
				// Proverite da li je pritisnut taster 'Esc'
				if (event.key === "Escape") {
					// Proverite da li je modal trenutno vidljiv pre nego što ga pokušate zatvoriti
					if (galleryModalSliderSel.classList.contains('is-visible')) {
						galleryModalSliderSel.classList.remove('is-visible');
					}
				}
			});
		}
	}
};

export default Sliders;
