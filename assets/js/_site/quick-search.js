'use strict';
const QuickSearch = {
    init: function() {
        var searchField = document.querySelector(".js-search-field"); // Pretpostavlja se da je ovo input polje za pretragu
        let searchTimeout = null;
        const loader = document.querySelector(".js-search-loader");
        const resultsDiv = document.querySelector(".js-search-results");

        searchField.addEventListener('input', function() {
            clearTimeout(searchTimeout); // Resetuje prethodni tajmer
            resultsDiv.innerHTML = '';
            var searchTerm = this.value;
            if (searchTerm.length < 3) {
                clearTimeout(searchTimeout); // Resetuje prethodni tajmer
                // Ne pretražujte ako je broj slova manji od 3
                return;
            }

            loader.style.display = 'block'; // Prikazuje loader

            // Odlaganje pretrage za 1 sekundu
            searchTimeout = setTimeout(function() {
                fetch(themeLocal.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                    },
                    body: new URLSearchParams({
                        action: 'perform_search', // Obratite pažnju na ispravku naziva akcije
                        term: encodeURIComponent(searchTerm)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    loader.style.display = 'none'; // Sakrij loader kada dobijete odgovor
                    resultsDiv.innerHTML = ''; // Očistite prethodne rezultate
                    resultsDiv.innerHTML = data.content; // Dodajte HTML direktno
                })
                .catch(error => {
                    console.error('Error:', error);
                    loader.style.display = 'none'; // Uvek sakrijte loader ako dođe do greške
                });
            }, 1000); // Odlaganje za 1000 milisekundi (1 sekunda)
        });
    }
};

export default QuickSearch;
