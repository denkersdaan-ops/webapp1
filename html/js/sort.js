let selectedCategoryId = null;

window.setCategories = function (categorie) {
    selectedCategoryId = categorie;

    var allButtons = [];
    allButtons = document.getElementsByClassName("category");

    var lastButton = document.getElementsByClassName("last-button")[0];

    if (lastButton && lastButton.id == categorie) {
        lastButton.classList.remove('last-button');
        lastButton = null;
        selectedCategoryId = null;
        console.log("Last button:");
        filterProducts();
        return
    }

    console.log("new button: " + selectedCategoryId);

    for (let i = 0; i < allButtons.length; i++) {
        allButtons[i].classList.remove('last-button');
    }

    var categoryButtons = document.getElementById(categorie);
    categoryButtons.classList.add('last-button');


    filterProducts();
}

window.get_idsort = function () {
    return selectedCategoryId;
}

window.filterProducts = function () {
    const productList = document.getElementById('product-list');
    const products = productList.querySelectorAll('[id^="categorie:"]');

    products.forEach(product => {
        if (selectedCategoryId === null) {
            product.style.display = '';
        } else {
            const productCatId = product.id.split(':')[1];
            product.style.display = productCatId === selectedCategoryId ? '' : 'none';
        }
    });
}