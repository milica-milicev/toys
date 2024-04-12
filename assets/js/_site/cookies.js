'use strict';
const Cookies = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		const cookies = document.querySelector('.js-cookies');
		const acceptButton = document.querySelector('.js-cookies-accept-btn');

		// Provera da li je korisnik već prihvatio kolačiće
		if (localStorage.getItem('cookiesAccepted') !== 'true') {
			cookies.classList.add('is-visible'); // Prikazuje obaveštenje ako kolačići nisu prihvaćeni
		}
	
		acceptButton.addEventListener('click', function() {
			cookies.classList.remove('is-visible'); // Sakrij obavestenje
	
			// Sačuvajte u localStorage da korisnik ne vidi obavestenje prilikom ponovne posete
			localStorage.setItem('cookiesAccepted', 'true');
		});
	}
};

export default Cookies;
