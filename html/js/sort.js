let selectedCategoryId = null;

window.setCategories = function (categorie) {
    selectedCategoryId = categorie;
    console.log("Selected category:", categorie);
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