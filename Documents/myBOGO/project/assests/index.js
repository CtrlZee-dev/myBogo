
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























//  // Function to add a product to the cart
//  function addToCart(productId, productName, productPrice) {
//     if (!localStorage.getItem('cart')) {
//         localStorage.setItem('cart', JSON.stringify([]));
//     }

//     // Retrieve existing cart items from localStorage
//     var cartItems = JSON.parse(localStorage.getItem('cart'));

//     // Add the new product to the cart
//     cartItems.push({
//         'id': productId,
//         'name': productName,
//         'price': productPrice
//     });

//     // Update the cart items in localStorage
//     localStorage.setItem('cart', JSON.stringify(cartItems));

//     // Update the cart UI
//     updateCartUI();
// }

// // Function to update the cart UI
// function updateCartUI() {
//     var cartItems = JSON.parse(localStorage.getItem('cart')) || [];
//     var cartItemsContainer = document.getElementById('cart-items');

//     // Clear previous cart items
//     cartItemsContainer.innerHTML = '';

//     // Add each product to the cart items container
//     cartItems.forEach(function(item) {
//         // Create a card element for the product/item
//         var card = document.createElement('div');
//         card.classList.add('card', 'border', 'shadow-none');

//         // Create the card body
//         var cardBody = document.createElement('div');
//         cardBody.classList.add('card-body');

//         // Create the content for the card body
//         var content = `
//             

//         // Set the content of the card body
//         cardBody.innerHTML = content;

//         // Append the card body to the card
//         card.appendChild(cardBody);

//         // Append the card to the cart items container
//         cartItemsContainer.appendChild(card);
//     });

//     // Calculate cart total
//     var cartTotal = cartItems.reduce((total, item) => total + parseFloat(item.price), 0).toFixed(2);

//     // Update cart total
//     var cartTotalElement = document.getElementById('cart-total');
//     if (cartTotalElement) {
//         cartTotalElement.textContent = 'Cart total: R' + cartTotal;
//     } else {
//         console.log("Cart total element not found.");
//     }
// }

// document.addEventListener("DOMContentLoaded", function() {
//     var addToCartButtons = document.querySelectorAll('.add-to-cart');

//     addToCartButtons.forEach(function(button) {
//         button.addEventListener('click', function() {
//             var productId = this.getAttribute('data-id');
//             var productName = this.getAttribute('data-name');
//             var productPrice = this.getAttribute('data-price');

//             // Log the product details to verify if the button click event is captured
//             console.log("Adding product to cart:", productId, productName, productPrice);

//             // Call the addToCart function to add the product to the cart
//             addToCart(productId, productName, productPrice);
//         });
//     });
// });

// // Call updateCartUI when the page loads
// window.onload = updateCartUI;








