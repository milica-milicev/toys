'use strict';
const ProductsFilter = {
    init: function() {
        const productsContainer = document.querySelector('.js-products');
        const filterOptions = document.querySelectorAll('.js-filter-option');
        const loader = document.querySelector('.js-products-loader'); // Uverite se da klasa odgovara vašem loader elementu
        let isFiltering = false;
        let currentPage = 1;
        let maxPages = parseInt(themeLocal.maxPages) || 1;
        const filters = document.querySelector('.js-filters');

        function showLoader() {
            loader.style.display = 'block';
        }

        function hideLoader() {
            loader.style.display = 'none';
        }

        function ajaxFilter(ageRange, page) {
            if (isFiltering) return;
            isFiltering = true;
            showLoader();
        
            const data = {
                action: 'filter_products_by_age',
                ageRange: ageRange.join(','),
                category: themeLocal.currentCategory || '',
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
                hideLoader();
                if (data.content) {
                    // productsContainer.innerHTML += data.content;
                    productsContainer.insertAdjacentHTML('beforeend', data.content);
                    maxPages = data.max_num_pages;
                }
                isFiltering = false;
            })
            .catch(error => {
                console.error('Došlo je do greške:', error);
                hideLoader();
                isFiltering = false;
            });
        }

        filterOptions.forEach(option => option.addEventListener('change', function() {
            let selectedAges = Array.from(filterOptions).filter(option => option.checked).map(option => option.value);
            currentPage = 1; // Resetujemo stranicu na prvu nakon filtriranja
            productsContainer.innerHTML = ''; // Očistite container pre ponovnog učitavanja
            ajaxFilter(selectedAges, currentPage);

            // Skrolujte do početka js-products div-a
            const productsPosition = productsContainer.getBoundingClientRect().top + window.pageYOffset - 120;

            window.scrollTo({
                top: productsPosition,
                behavior: 'smooth'
            });

            // for mobile views when filters are active and over the page
            if (filters.classList.contains('is-active')) {
                filters.classList.remove('is-active');
            }
        }));


        function checkScroll() {
            const rect = productsContainer.getBoundingClientRect();
            const isAtEnd = rect.bottom <= window.innerHeight + 100;

            if (isAtEnd && currentPage < maxPages && !isFiltering) {
                currentPage++; // Sada zatražite sledeću stranicu proizvoda
                let selectedAges = Array.from(filterOptions).filter(option => option.checked).map(option => option.value);
                ajaxFilter(selectedAges, currentPage);
            }
        }

        if (productsContainer) {
            window.addEventListener('scroll', checkScroll);
        }
    }
};

export default ProductsFilter;
