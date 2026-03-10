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
                        <button class="add box-shadow">+</button>
                    </div>
                </article>
            </div>
        `;
        
        const button = div.querySelector('button');
        button.addEventListener('click', () => {
            const product = JSON.parse(productData);
            addToCart(product);
        });
        
        this.appendChild(div);
    }
}

customElements.define('product-item', ProductItem);