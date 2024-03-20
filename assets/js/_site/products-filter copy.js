
'use strict';
const ProductsFilter = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
        const productsContainer = document.querySelector('.js-products');
        const filterOption = document.querySelectorAll('.js-filter-option');
        const noResults = document.querySelector('.js-team-no-results');
        const loader = document.querySelector('.js-loader');
        const animatedClass = 'is-animated';
        let currentPage = 1;
        let loading = false;
        const maxPages = themeLocal.maxPages; // Pristup maxPages preko objekta themeLocal
        let loadedProductIds = [];

        window.onscroll = function() {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && !loading && currentPage < maxPages) {
                
                loading = true;
                currentPage++;
                ajaxFilter({
                    action: 'filter_products',
                    selected_age: selectedAges.join(','),
                    page: currentPage,
                    loaded_product_ids: loadedProductIds
                });
            }
        };

        function ajaxFilter(data) {
            console.log(data);
            data.loadedProductIds = loadedProductIds.join(',');
            // Kreira URLSearchParams iz prosleđenih podataka
            const params = new URLSearchParams();
            for (const key in data) {
                if (data.hasOwnProperty(key)) {
                    params.append(key, data[key]);
                }
            }

            fetch(themeLocal.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                },
                body: params
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }
                return response.json();
            })
            .then(data => {
                if (data) {
                    console.log(data.data);
                    // Samo dodajte nove proizvode, umesto da brišete sve stare
                    productsContainer.innerHTML += data.data.content;

                    loadedProductIds = loadedProductIds.concat(data.data.productIds);
                } else {
                    if (currentPage === 1) { // Ako nema rezultata samo na prvoj stranici
                        productsContainer.innerHTML = ''; // Pražnjenje ako nema rezultata
                        // noResults.style.display = 'block'; // Prikaz "Nema rezultata"
                    }
                }
                // loader.style.display = 'none'; // Skrivanje loadera
                loading = false; // Dozvoljeno je novo učitavanje
                
            })
            .catch(error => console.error('Error:', error));
        }

        let selectedAges = [];
        filterOption.forEach(option => {
            option.addEventListener('click', function() {
                selectedAges = []; // Resetujte niz odabranih uzrasta
                currentPage = 1; // Resetujte na prvu stranicu
                productsContainer.innerHTML = ''; // Očistite postojeće proizvode
                
                
                filterOption.forEach(option => { // Ponovo proverite koji su checkbox-ovi čekirani
                    if (option.checked) {
                        selectedAges.push(option.value);
                    }
                });
        
                // Ponovo učitajte proizvode sa novim filterima
                ajaxFilter({
                    action: 'filter_products',
                    selected_age: selectedAges.join(','),
                    page: currentPage,
                    loaded_product_ids: loadedProductIds
                });
            });
        });
	}
};

export default ProductsFilter;
