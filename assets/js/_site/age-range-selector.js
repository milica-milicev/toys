'use strict';
const AgeRangeSelector = {
    init: function() {
        const tileItems = document.querySelectorAll('.js-tile-item');
        
        tileItems.forEach(link => {
            link.addEventListener('click', function() {
                const ageRange = this.getAttribute('data-age-range');
                localStorage.setItem('selectedAgeRange', ageRange);
            });
        });

        const selectedAgeRange = localStorage.getItem('selectedAgeRange');
        if (selectedAgeRange) {
            const filterOption = document.querySelector(`.js-filter-option[value="${selectedAgeRange}"]`);
            if (filterOption) {
                filterOption.checked = true;
                // Simulirajte promenu da bi se iniciralo filtriranje
                filterOption.dispatchEvent(new Event('change'));
    
                // Čišćenje Local Storage
                localStorage.removeItem('selectedAgeRange');
            }
        }
    }
};

export default AgeRangeSelector;
