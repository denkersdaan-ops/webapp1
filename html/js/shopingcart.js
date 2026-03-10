
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

        cartItems.innerHTML += `<p>${item.name} × ${item.quantity} : €${itemTotal.toFixed(2)}</p>`;
    });

    totalElement.innerHTML = "Totaal: €" + total.toFixed(2);
}

function pay() {

    console.log("Cart contents: ");

    fetch("products.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "ids=" + cart.map(item => item.id + ":" + item.quantity).join(",")
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
        });

    alert("Bedankt voor uw aankoop! Uw totale bedrag is: " + cart.reduce((sum, item) => sum + item.price * item.quantity, 0).toFixed(2));

    cart = [];
    loadCartItems();
}