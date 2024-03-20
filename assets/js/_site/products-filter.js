'use strict';
const ProductsFilter = {
    init: function () {
        const productsContainer = document.querySelector('.js-products');
        const filterOptions = document.querySelectorAll('.js-filter-option');
        const loader = document.querySelector('.js-products-loader');
        let isFiltering = false;
        let currentPage = 1;
        let maxPages = parseInt(themeLocal.maxPages) || 1;

        function showLoader() {
            loader.style.display = 'block'; // Prikazuje loader
        }

        function hideLoader() {
            loader.style.display = 'none'; // Skriva loader
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
                    if (currentPage === 1) {
                        productsContainer.innerHTML = data.content;
                    } else {
                        productsContainer.insertAdjacentHTML('beforeend', data.content);
                    }
                    currentPage++;
                    if (data.max_num_pages) {
                        maxPages = data.max_num_pages;
                    }
                    observeLastProduct(); // Ponovo postavite observer na novi poslednji proizvod
                }
                isFiltering = false;
            })
            .catch(error => {
                console.error('Došlo je do greške:', error);
                hideLoader();
                isFiltering = false;
            });
        }

        // Intersection Observer Setup
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && currentPage <= maxPages && !isFiltering) {
                    let selectedAges = Array.from(filterOptions).filter(option => option.checked).map(option => option.value);
                    ajaxFilter(selectedAges, currentPage);
                }
            });
        }, { rootMargin: '0px', threshold: 0.1 });

        // Funkcija za posmatranje poslednjeg proizvoda
        function observeLastProduct() {
            const products = document.querySelectorAll('.js-products .product');
            if (products.length > 0) {
                observer.observe(products[products.length - 1]);
            }
        }

        filterOptions.forEach(option => option.addEventListener('change', function() {
            let selectedAges = Array.from(filterOptions).filter(option => option.checked).map(option => option.value);
            currentPage = 1; // Resetujemo stranicu na prvu
            ajaxFilter(selectedAges, currentPage);
        }));

        observeLastProduct(); // Postavite observer na poslednji proizvod pri inicijalizaciji
    }
};

document.addEventListener('DOMContentLoaded', ProductsFilter.init);

export default ProductsFilter;
