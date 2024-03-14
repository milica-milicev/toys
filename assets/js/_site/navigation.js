'use strict';
const Navigation = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		const menuBtn = document.querySelector('.js-menu-btn');
		const navigation = document.querySelector('.js-navigation');
		const searchForm = document.querySelector('.js-search-form');

		if (navigation) {
			menuBtn.addEventListener('click', function() {
				this.classList.toggle('is-active');
				navigation.classList.toggle('is-active');
				searchForm.classList.remove('is-active');
			});
		}
	}
};

export default Navigation;
