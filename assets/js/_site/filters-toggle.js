'use strict';
const FiltersToggle = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		const filtersToggleBtn = document.querySelector('.js-filters-toggle');
		const filters = document.querySelector('.js-filters');
		const filtersCloseBtn = document.querySelector('.js-filters-close');
		
		if (filtersToggleBtn) {
			filtersToggleBtn.addEventListener('click', function(e) {
				e.preventDefault();
				filters.classList.toggle('is-active');
			});

			filtersCloseBtn.addEventListener('click', function(e) {
				e.preventDefault();
				filters.classList.remove('is-active');
			});
		}
	}
};

export default FiltersToggle;
