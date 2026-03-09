class ProductItem extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        if (this.querySelector('div')) return; // Already initialized

        const name = this.getAttribute('name');
        const info = this.getAttribute('info');
        const price = this.getAttribute('price');
        const categorieId = this.getAttribute('categorie_id');
        const productData = this.getAttribute('product');

        const div = document.createElement('div');
        div.id = `categorie:${categorieId}`;
        div.className = 'current-category';

        div.innerHTML = `
            <div class="stripe-shadow rounded">
                <article class="product box-shadow">
                    <div>
                        <h2>${name}</h2>
                        <p>${info}</p>
                    </div>
                    <p class="prijs">€${price}</p>
                    <div class="stripe-shadow rounded">
                        <button class="add box-shadow" product='${productData}'>+<button>
                    </div>
                </article>
            </div>
        `;

        

        this.appendChild(div);
    }
}

customElements.define('product-item', ProductItem);

class AddToCartButton extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        if (this.querySelector('button')) return; // Already initialized

        const button = document.createElement('button');
        button.className = 'add box-shadow';
        button.textContent = '+';
        button.addEventListener('click', () => {
            const product = JSON.parse(this.getAttribute('product'));
            addToCart(product);
            
        });

        const outline = document.createElement('div');
        outline.className = 'stripe-shadow rounded';
        outline.appendChild(button);
        this.appendChild(outline);
    }
}

customElements.define('add-to-cart-button', AddToCartButton);