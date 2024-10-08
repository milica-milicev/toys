'use strict';
const Search = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		const searchBtn = document.querySelector('.js-search-btn');
		const searchForm = document.querySelector('.js-search-form');
		const searchFormInput = document.querySelector('.js-search-field');
		const searchFormCloseBtn = document.querySelector('.js-close-search');
		const navigation = document.querySelector('.js-navigation');
		const menuBtn = document.querySelector('.js-menu-btn');
		const resultsDiv = document.querySelector(".js-search-results");
		
		if (searchForm) {
			searchBtn.addEventListener('click', function(e) {
				e.preventDefault();
				this.classList.toggle('is-active');
				searchForm.classList.toggle('is-active');
				searchFormInput.focus();
				searchFormInput.value = '';
				navigation.classList.remove('is-active');
				menuBtn.classList.remove('is-active');

				if (e.target.classList.contains('is-active')) {
					resultsDiv.innerHTML = '';
				}
			});

			searchFormCloseBtn.addEventListener('click', function(e) {
				e.preventDefault();
				this.classList.remove('is-active');
				searchForm.classList.remove('is-active');
				searchFormInput.value = '';
				resultsDiv.innerHTML = '';
			});
		}
	}
};

export default Search;
