'use strict';
const QtyCounter = {
    init: function() {
        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('js-qty-plus') || e.target.classList.contains('js-qty-minus')) {
                const btn = e.target;
                const input = btn.parentNode.querySelector('.qty');
                let inputValue = parseInt(input.value, 10);
        
                if (btn.classList.contains('js-qty-plus')) {
                    inputValue++;
                } else if (btn.classList.contains('js-qty-minus')) {
                    if (inputValue > 1) {
                        inputValue--;
                    } else {
                        inputValue = 1; // Prevent the value from going below 1
                    }
                }

                input.value = inputValue;
            }
        });
        
        // Prevent manual entry of negative numbers
        document.body.addEventListener('change', function(e) {
            if (e.target.classList.contains('js-qty-field')) {
                const input = e.target;
                let inputValue = parseInt(input.value, 10);

                if (inputValue < 1) {
                    input.value = 1;
                }
            }
        });
    }
};

export default QtyCounter;
