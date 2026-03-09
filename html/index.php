<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastfood</title>
    <link rel="stylesheet" href="styles.css?v=1">
</head>

<body>

    <header class="header">

        <!-- LOGO -->
        <div class="stripe-shadow">
            <div class="logo box-shadow box-content">FASTFOOD</div>
        </div>

        <!-- NAV -->
        <nav class="header-nav">
            <div class="stripe-shadow nav">
                <a class="box-shadow box-content" href="#">Home</a>
            </div>
            <div class="stripe-shadow nav">
                <a class="box-shadow box-content" href="#">Menu</a>
            </div>
            <div class="stripe-shadow nav">
                <a class="box-shadow box-content" href="#">Contact</a>
            </div>
        </nav>

    </header>

    <main>

        <!-- HERO / CALL TO ACTION -->
        <div class="stripe-shadow">
            <section class="hero box-shadow box-content">
                <h1>Snelle, minimalistische fastfood.</h1>
                <p>Rustig, simpel, en stijlvol genieten.</p>

                <div class="stripe-shadow stripe-minimal">
                    <button class="cta box-shadow box-content" onclick="pay()">Bestel nu</button>
                </div>


            </section>
        </div>

        <section class="layout">

            <!-- CATEGORIEËN -->
            <aside class="categories" id="category-list">
                <button class="category box-shadow"><span>🍔</span></button>
            </aside>

            <!-- PRODUCTEN -->
            <section class="products" id="product-list">
                <article class="product box-shadow">
                    <div>
                        <h2>Classic Burger</h2>
                        <p>Minimalistische burger</p>

                    </div>
                    <p class="prijs">€7.95</p>
                    <button class="add box-shadow">+</button>
                </article>

                <!-- <article class="product box-shadow">
                <div>
                    <h2> Naam </h2>
                    <p> info </p>
                </div>
                <p class="prijs">€7.95</p>
                <button class="add box-shadow">+</button>
            </article>
            -->


            </section>

            <!-- WINKELMAND -->
            <aside class="cart box-shadow">
                <h3>Shopping cart</h3>
                <p>Product: ... :Prijs:</p>
                <hr>
                <p><strong>Totaal:</strong></p>
            </aside>

        </section>

    </main>

    <script>
        // Vraag een HTML-fragment op bij products.php
        fetch('/api/categories.php')
            .then(response => response.text())
            .then(html => {
                document.getElementById('category-list').innerHTML = html;
            })
            .catch(err => {
                document.getElementById('category-list').innerHTML =
                    "<li>Kan data niet laden</li>";
                console.error(err);
            });
    </script>

    <script>
        // Vraag een HTML-fragment op bij products.php
        fetch('/api/products.php')
            .then(response => response.text())
            .then(html => {
                document.getElementById('product-list').innerHTML = html;
            })
            .catch(err => {
                document.getElementById('product-list').innerHTML =
                    "<li>Kan data niet laden</li>";
                console.error(err);
            });
    </script>

</body>

</html>