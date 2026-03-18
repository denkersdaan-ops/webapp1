function addMode(type) {
    setMode(type);
}

function removeMode(type) {
    setMode(type);
}

function changeMode(type) {
    setMode(type);
}

window.addEventListener("DOMContentLoaded", () => {
    const savedMode = sessionStorage.getItem("adminMode");
    if (savedMode) {
        setMode(savedMode);
    }
});

function setMode(type) {
    sessionStorage.setItem("adminMode", type);

    var categories = document.getElementById("categories-list");
    var products = document.getElementById("products-list");

    categories.removeEventListener('click', removeCategorie);
    categories.removeEventListener('click', changeCategory);
    products.removeEventListener('click', removeProduct);
    products.removeEventListener('click', changeProduct);

    var currentCategory = document.getElementById("admin-controls");
    if (currentCategory) {
        currentCategory.remove();
    }

    if (type == "add-category" || type == "change-category" || type == "remove-category") {
        categories.parentNode.style.marginBottom = "10vh";
        categories.parentNode.parentNode.parentNode.style.width = "70%";
        products.parentNode.parentNode.parentNode.style.width = "30%";
        products.parentNode.style.removeProperty("margin-bottom");

        if (type == "add-category") {
            const div = document.createElement('div');
            div.id = "admin-controls";
            div.innerHTML = `
                <h2>Add category</h2>
                <p>Fill in the form to add a new category.</p>
                <form id="add-category-form">
                    <input type="text" name="name" placeholder="Category name" required>
                    <input type="text" name="image" placeholder="Category image path" required>
                    <button type="submit">+</button>
                </form>
            `;

            categories.parentNode.appendChild(div);

            addBtn("add-category", "add-category-form");
        } else if (type == "change-category") {
            const div = document.createElement('div');
            div.id = "admin-controls";
            div.innerHTML = `
                <h2>Change category</h2>
                <p>Click on the category you want to change.</p>
            `;

            categories.parentNode.appendChild(div);

            categories.addEventListener('click', changeCategory);
        } else if (type == "remove-category") {
            const div = document.createElement('div');
            div.id = "admin-controls";
            div.innerHTML = `
                <h2>Remove category</h2>
                <p>Click on the category you want to remove.</p>
            `;

            categories.parentNode.appendChild(div);
            categories.addEventListener('click', removeCategorie);
        }

    } else if (type == "add-product" || type == "change-product" || type == "remove-product") {
        products.parentNode.style.marginBottom = "10vh";
        products.parentNode.parentNode.parentNode.style.width = "70%";
        categories.parentNode.parentNode.parentNode.style.width = "30%";
        categories.parentNode.style.removeProperty("margin-bottom");

        if (type == "add-product") {
            const div = document.createElement('div');
            div.id = "admin-controls";
            div.innerHTML = ` 
                <h2>Add product</h2>
                <p>Fill in the form to add a new product.</p>
                <form id="add-product-form">
                    <input type="text" name="name" placeholder="Product name" required>
                    <input type="text" name="info" placeholder="Product info" required>
                    <input type="number" step="0.01" name="price" placeholder="Product price" required>
                    <input type="text" name="category_id_name" placeholder="Click category" readonly required>
                    <input type="hidden" name="category_id" required>
                    <button type="submit">+</button>
                </form>
            `;
            products.parentNode.appendChild(div);
            addBtn("add-product", "add-product-form");
        }

        if (type == "change-product") {
            const div = document.createElement('div');
            div.id = "admin-controls";
            div.innerHTML = `
                <h2>Change product</h2>
                <p>Click on the product you want to change.</p>
            `;

            products.parentNode.appendChild(div);

            products.addEventListener('click', changeProduct);
        }

        if (type == "remove-product") {
            const div = document.createElement('div');
            div.id = "admin-controls";
            div.innerHTML = ` <h2>Remove product</h2>
                <p>Click on the product you want to remove.</p>
                `;

            products.parentNode.appendChild(div);

            products.addEventListener('click', removeProduct);

        }
    }
}

function addBtn(action, from) {
    document.getElementById(from).addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);
        console.log('Form data:', Object.fromEntries(formData.entries()));

        try {
            const response = await fetch('php/productManager.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: action,
                    data: JSON.stringify(Object.fromEntries(formData.entries()))
                })
            });

            const text = await response.text();

            let result;
            try {
                result = JSON.parse(text);
            } catch (parseError) {
                throw new Error('Invalid JSON returned from PHP: ' + text);
            }

            if (result.success) {
                const message = action.includes('change') ? 'Item updated!' : 'Item added!';
                alert(message);
                location.reload();
            } else {
                alert('Error: ' + result.message);
                console.log(result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred: ' + error.message);
        }

        location.reload();
    });


}

async function removeCategorie(e) {
    const category = e.target.id;
    console.log(category);
    categoryId = category.split('-')[1]; // split after the - and take the second part as ID 
    console.log(categoryId);


    if (category) {
        if (!confirm('Are you sure you want to delete this category?')) {
            return;
        }
        try {
            const response = await fetch('php/productManager.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: "remove-category",
                    id: categoryId
                })
            });

            const text = await response.text();

            let result;
            try {
                result = JSON.parse(text);
            } catch (parseError) {
                throw new Error('Invalid JSON returned from PHP: ' + text);
            }

            if (result.success) {
                alert('Category deleted!');
                location.reload();
            } else {
                alert('Fout: ' + result.message);
                console.log(result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Er is een fout opgetreden: ' + error.message);
        }
    }
}

async function removeProduct(e) {
    const product = e.target.id;
    console.log(product);
    productId = product.split('-')[1]; // split after the - and take the second part as ID 
    console.log(productId);

    if (product) {
        if (!confirm('Are you sure you want to delete this product?')) {
            return;
        }
        try {
            const response = await fetch('php/productManager.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: "remove-product",
                    id: productId
                })
            });

            const text = await response.text();

            let result;
            try {
                result = JSON.parse(text);
            } catch (parseError) {
                throw new Error('Invalid JSON returned from PHP: ' + text);
            }

            if (result.success) {
                alert('Product deleted!');
                location.reload();
            } else {
                alert('Fout: ' + result.message);
                console.log(result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Er is een fout opgetreden: ' + error.message);
        }
    }
}

function changeCategory(e) {
    const categoryElement = e.target.closest('[id^="category-"]');
    if (!categoryElement) return;
    const categoryId = categoryElement.id.split('-')[1];

    // Fetch category data from server
    fetch('php/productManager.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: "get-category",
            id: categoryId
        })
    })
        .then(response => response.text())
        .then(text => {
            let result;
            try {
                result = JSON.parse(text);
            } catch (parseError) {
                throw new Error('Invalid JSON returned from PHP: ' + text);
            }

            if (result.success) {
                const category = result.data;

                const existingForm = document.getElementById('change-category-form');
                if (existingForm) existingForm.remove();

                const form = document.createElement('form');
                form.id = 'change-category-form';
                form.innerHTML = `
                <input type="hidden" name="id" value="${category.id}">
                <input type="text" name="name" value="${category.name}" placeholder="Category name" required>
                <input type="text" name="image" value="${category.image}" placeholder="Category image path" required>
                <button type="submit">Update</button>
            `;

                const controls = document.getElementById('admin-controls');
                controls.appendChild(form);

                addBtn("change-category", "change-category-form");
            } else {
                alert('Error: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred: ' + error.message);
        });
}

function changeProduct(e) {
    const productElement = e.target.closest('[id^="product-"]');
    if (!productElement) return;
    const productId = productElement.id.split('-')[1];

    // Fetch product data from server
    fetch('php/productManager.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: "get-product",
            id: productId
        })
    })
        .then(response => response.text())
        .then(text => {
            let result;
            try {
                result = JSON.parse(text);
            } catch (parseError) {
                throw new Error('Invalid JSON returned from PHP: ' + text);
            }

            if (result.success) {
                const product = result.data;

                const existingForm = document.getElementById('change-product-form');
                if (existingForm) existingForm.remove();

                const category_id_name = document.getElementById('category-' + product.category_id).value.split(': ')[1]; // Get category name from the button value

                const form = document.createElement('form');
                form.id = 'change-product-form';
                form.innerHTML = `
                <input type="hidden" name="id" value="${product.id}">
                <input type="text" name="name" value="${product.name}" placeholder="Product name" required>
                <input type="text" name="info" value="${product.info}" placeholder="Product info" required>
                <input type="number" step="0.01" name="price" value="${product.price}" placeholder="Product price" required>
                <input type="hidden" name="category_id" value="${product.category_id}" required>
                <input type="text" name= "category_id_name" value="${category_id_name}" placeholder="click a category">
                <button type="submit">Update</button>
            `;

                const controls = document.getElementById('admin-controls');
                controls.appendChild(form);

                addBtn("change-product", "change-product-form");
            } else {
                alert('Error: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred: ' + error.message);
        });
}

var submitButtons = document.getElementsByClassName("submit-btn");

for (var i = 0; i < submitButtons.length; i++) {
    submitButtons[i].addEventListener("click", function (e) {
        e.preventDefault();

        var buttonId = e.target.id;
        var idParts = buttonId.split('-');
        var type = idParts[0]; // "category" or "product"
        var itemId = idParts.slice(1).join('-'); // Get the ID part

        if (type === "category") {
            const button = document.getElementById(buttonId);
            const categoryName = button.value.split(': ')[1];

            console.log("Category button clicked:", categoryName, "(id=" + itemId + ")");

            // Set the visible category name field (for selecting category in product form)
            const categoryNameInput = document.querySelector('input[name="category_id_name"]');
            categoryNameInput.value = categoryName;


            // Set the actual category id field (used when saving product)
            const categoryIdInput = document.querySelector('input[name="category_id"]');            
            categoryIdInput.value = itemId;


            console.log("Category selected:", categoryName, "(id=" + itemId + ")");
        }
    });
}