
'use strict';
const ProductsFilter = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {

//         const checkboxes = document.querySelectorAll('input[name="age_range[]"]');

// checkboxes.forEach(function(checkbox) {
//     checkbox.addEventListener('change', function() {
//         let selectedFilters = [];
//         document.querySelectorAll('input[name="age_range[]"]:checked').forEach(function(checkedBox) {
//             selectedFilters.push(checkedBox.value);
//         });
//         // Kreirajte string pretrage sa '+' umesto automatskog kodiranja
//         const searchParams = 'uzrast=' + selectedFilters.join('+');
//         window.location.search = searchParams;
//     });
// });

        const teamSel = document.querySelector('.js-products');
        const filterOption = document.querySelectorAll('.js-filter-option');
        const noResults = document.querySelector('.js-team-no-results');
        const loader = document.querySelector('.js-loader');
        const animatedClass = 'is-animated';

        function ajaxFilter(data) {
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
                console.log(data.data); 
                // noResults.style.display = 'none';
                teamSel.innerHTML = ''; // Pražnjenje tim selektora
                // loader.style.display = 'block'; // Prikaz loadera
                if (data) {
                    teamSel.innerHTML = data.data; // Dodavanje odgovora u tim selektor
                    // const currentProfileItems = document.querySelectorAll('.js-profile');

                    // currentProfileItems.forEach(item => {
                    //     const profileWrap = item.querySelector('.js-profile-wrap');
                    //     profileWrap.classList.remove(animatedClass);
                    //     profileWrap.style.display = 'none';
                    //     profileWrap.classList.add(animatedClass);
                    //     profileWrap.style.display = 'block';
                    // });
                } else {
                    teamSel.innerHTML = ''; // Pražnjenje tim selektora ako nema rezultata
                    // noResults.style.display = 'block'; // Prikaz "Nema rezultata"
                }
                // loader.style.display = 'none'; // Skrivanje loadera
            })
            .catch(error => console.error('Error:', error));
        }

        let selectedAges = [];
        filterOption.forEach(option => {
            option.addEventListener('click', function() {
                // const selectedAge = this.value;

                if (option.checked) {
                    selectedAges.push(option.value);
                }


                // Podaci za slanje
                const data = {
                    action: 'filter_products',
                    selected_age: selectedAges.join(','),
                };
                console.log(data);
                ajaxFilter(data);
            });
        });


  
	}
};

export default ProductsFilter;
