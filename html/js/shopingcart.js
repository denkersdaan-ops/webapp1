
var cart = [];

function addToCart(product) {
    let existing = cart.find(item => item.id === product.id);

    if (existing) {
        existing.quantity++;
    } else {
        product.quantity = 1;
        cart.push(product);
    }

    loadCartItems();
}

function loadCartItems() {
    let cartItems = document.getElementById("cart-items");
    let totalElement = document.getElementById("total");

    cartItems.innerHTML = "";

    let total = 0;

    cart.forEach(item => {
        let itemTotal = item.price * item.quantity;
        total += itemTotal;

        var newItem = `<div class="cart-item ">
        <p>${item.name} × ${item.quantity} : €${itemTotal.toFixed(2)}</p>
        <div class="stripe-shadow rounded">
        <button class="remove box-shadow box-content" onclick="removeFromCart(${item.id})">-</button>
        </div>
        </div>`;

        cartItems.innerHTML += newItem;
    });

    totalElement.innerHTML = "Totaal: €" + total.toFixed(2);
}

function removeFromCart(productId) {
    let existing = cart.find(item => item.id === productId);
    if (existing) {
        existing.quantity--;
        if (existing.quantity <= 0) {
            cart = cart.filter(item => item.id !== productId);
        }
    }
    loadCartItems();
}

function pay() {

    console.log("Cart contents: ");

    let ids = [];
    let quantity = [];

    for(let i = 0; i < cart.length; i++){
        ids[i] = cart[i].id;
        quantity[i] = cart[i].quantity;
    }

    fetch("../php/products.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            ids: ids,
            quantity: quantity 
        })
    });
    alert("Bedankt voor uw aankoop! Uw totale bedrag is: " + cart.reduce((sum, item) => sum + item.price * item.quantity, 0).toFixed(2));

    cart = [];
    loadCartItems();
}