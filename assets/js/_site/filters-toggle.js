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

			// Dodajte event listener na document za osluškivanje keydown događaja
			document.addEventListener('keydown', function(event) {
				// Proverite da li je pritisnut taster 'Esc'
				if (event.key === "Escape") {
					// Proverite da li je modal trenutno vidljiv pre nego što ga pokušate zatvoriti
					if (filters.classList.contains('is-active')) {
						filters.classList.remove('is-active');
					}
				}
			});
		}
	}
};

export default FiltersToggle;
