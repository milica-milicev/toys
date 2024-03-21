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


	}
};

export default Sliders;
