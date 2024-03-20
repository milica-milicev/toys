
'use strict';
const ProductsFilter = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
        const productsContainer = document.querySelector('.js-products');
        const filterOptions = document.querySelectorAll('.js-filter-option');
        let isFiltering = false;
        let currentPage = 1;
        let maxPages = parseInt(themeLocal.maxPages) || 1;
        
        function ajaxFilter(ageRange, page) {
            if (isFiltering) return;
            isFiltering = true;

            const data = {
                action: 'filter_products_by_age',
                ageRange: ageRange.join(','),
                category: themeLocal.currentCategory || '', // Pretpostavljam da imate ovu informaciju
                paged: page
            };
            
            fetch(themeLocal.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                },
                body: new URLSearchParams(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.content) {
                    if (currentPage === 1) {
                        productsContainer.innerHTML = data.content;
                    } else {
                        productsContainer.insertAdjacentHTML('beforeend', data.content);
                    }
                    currentPage++; // Povećajte za učitavanje sledeće stranice
                    if (data.max_num_pages) {
                        maxPages = data.max_num_pages;
                    }
                }
                isFiltering = false;
            })
            .catch(error => {
                console.error('Došlo je do greške:', error);
                isFiltering = false;
            });
        }
    
        filterOptions.forEach(option => option.addEventListener('change', function() {
            let selectedAges = Array.from(filterOptions)
                                    .filter(option => option.checked)
                                    .map(option => option.value);
            currentPage = 1;
            ajaxFilter(selectedAges, currentPage);
        }));
    
        window.addEventListener('scroll', () => {
            const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
            if (scrollTop + clientHeight >= scrollHeight - 5 && currentPage <= maxPages && !isFiltering) {
                let selectedAges = Array.from(filterOptions)
                                        .filter(option => option.checked)
                                        .map(option => option.value);
                ajaxFilter(selectedAges, currentPage);
            }
        });
    }
};

export default ProductsFilter;
