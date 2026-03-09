<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastfood</title>
    <link rel="stylesheet" href="css/styles.css?v=1">
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
            <div class="stripe-shadow rounded">
                <aside class="categories box-shadow box-content" id="category-list">
                </aside>
            </div>

            <!-- PRODUCTS SCROLLBOX (mag GEEN shadow wrapper krijgen) -->
            <div class="stripe-shadow stripe-maximal rounded">
                <section class="products box-shadow box-content" id="product-list">
                </section>
            </div>
            <!-- CART -->
            <div class="stripe-shadow rounded">
                <aside class="cart box-shadow box-content">
                    <h3>Shopping cart</h3>
                    <p id="cart-items"></p>
                    <hr>
                    <p><strong id="total">Totaal:</strong></p>
                </aside>
            </div>
        </section>

    </main>
</body>

</html>