

let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
console.log(cart); 
// Load cart from session storage

// Initialize cart display on page load
$(document).ready(function () {
    updateCartDisplay();
});
// Add to Cart Functionality

$(document).on('click', '.add-to-order', function () {
    if(sessionLoggedIn){
    const dishCard = $(this).closest('.dish-card');
    const dishId = dishCard.data('id');
    const dishName = dishCard.data('name');
    const dishPrice = parseFloat(dishCard.data('price'));

    cart.push({ id: dishId, name: dishName, price: dishPrice });
    updateCartDisplay();
    alert(`${dishName} added to cart!`);
}else{
    alert("PLEASE LOGIN!")
}
});


// Remove Item from Cart
function removeFromCart(index) {
    cart.splice(index, 1); // Remove item from array
    updateCartDisplay();
}

// Clear the Entire Cart
function clearCart() {
    cart = [];
    updateCartDisplay();
}

// Toggle Cart Dropdown
$('#cartButton').on('click', function () {
    $('#cartDropdown').toggle();
});
$('#proceed').on('click', function () {
    $('#cartDropdown').toggle();
});

// Update Cart Display and Session Storage
function updateCartDisplay() {
    let cartList = $('#cartItemsList');
    cartList.empty(); // Clear the list before adding items
    let total = 0;

    cart.forEach((item, index) => {
        total += item.price;
        cartList.append(`
            <li class='itemscart'>${item.name} - $${item.price.toFixed(2)} 
                <button onclick="removeFromCart(${index})">Remove</button>
            </li>
        `);
    });

    $('#cartCount').text(cart.length);
    $('#cartTotal').text(total.toFixed(2));

    // Save cart data in session storage
    sessionStorage.setItem('cart', JSON.stringify(cart));
    // Send cart data to PHP using AJAX for persistent sessions
    $.post('update_cart.php', { cart: JSON.stringify(cart) });
    console.log(cart);
}
