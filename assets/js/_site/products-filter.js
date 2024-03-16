
'use strict';
const ProductsFilter = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
        const categorySelect = document.getElementById('category-select');
        const filteredProducts = document.getElementById('filtered-products');

        // Event listener za promjenu vrijednosti u select elementu
        categorySelect.addEventListener('change', function() {
            let category = categorySelect.value;

            // AJAX zahtjev
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        filteredProducts.innerHTML = xhr.responseText;
                    } else {
                        console.error('Došlo je do greške prilikom dohvatanja proizvoda.');
                    }
                }
            };

            // Slanje AJAX zahtjeva
            xhr.open('GET', ajax_object.ajax_url + '?action=filter_products&category=' + encodeURIComponent(category), true);
            xhr.send();
        });
	}
};

export default ProductsFilter;
