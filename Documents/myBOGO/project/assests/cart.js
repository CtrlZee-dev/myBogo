
document.addEventListener("DOMContentLoaded", () => {
    const cartSidePane = document.getElementById('cart-side-pane');


    function attachCartEventListener() {
        const cartImgs = document.querySelectorAll('.cart-img');
        const closeBtn = document.querySelector('.close-btn');

        cartImgs.forEach(cartImg => {
            cartImg.addEventListener('click', openCartPane);
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', closeCartPane);
        }
    }

    function openCartPane() {
        const cartSidePane = document.getElementById('cart-side-pane');
        cartSidePane.classList.add('open');
    }
    
    function closeCartPane() {
        cartSidePane.classList.remove('open');
    }

 

    // Initial attachment of event listeners
    attachCartEventListener();




    

    
});
