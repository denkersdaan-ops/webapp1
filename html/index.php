<?php

$host = "db";              // de Docker service-naam!
$dbname = "mydatabase";    // uit jouw docker-compose
$username = "user";        // MYSQL_USER
$password = "password";    // MYSQL_PASSWORD

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo "Database fout: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastfood</title>
    <link rel="stylesheet" href="css/styles.css?v=1">

    <script src="js/sort.js?v=1"></script>
    <script src="js/defer.js?v=1"></script>
    <script src="js/shopingcart.js?v=1"></script>
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
                <?php
                $stmt = $pdo->query("SELECT * FROM categorie ORDER BY id");
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);


                if (!$stmt) {
                    $error = $pdo->errorInfo();
                    die("Query-fout: " . $error[2]);
                }

                if (!is_array($categories)) {
                    error_log('categories.php: Categories data is not an array. Check database connection and query.');
                    $categories = [
                        ["description" => "Demo category", "img" => "../images/demo.png"],
                    ];
                }
                ?>


                <aside class="categories box-shadow box-content" id="category-list">
                    <?php
                    foreach ($categories as $C) {
                        $description = htmlspecialchars($C["name"]);
                        $img = htmlspecialchars($C["image"]);
                        $id = htmlspecialchars($C["id"]);
                        ?>
                        <div class="stripe-shadow rounded"> <button id="<?php echo $id; ?>" onclick="setCategories(this.id)"
                                class="category box-shadow"><img class="category-icon" src="<?php echo $img; ?>"
                                    alt="<?php echo $description; ?>"></button></div>
                        <?php
                    }
                    ?>
                </aside>
            </div>

            <!-- PRODUCTS SCROLLBOX (mag GEEN shadow wrapper krijgen) -->
            <div class="stripe-shadow stripe-maximal rounded">
                <?php
                // Load all products - filtering happens in JavaScript
                $stmt = $pdo->query("SELECT * FROM product ORDER BY categorie_id");
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);


                if (!$stmt) {
                    $error = $pdo->errorInfo();
                    die("Query-fout: " . $error[2]);
                }

                if (!is_array($products)) {
                    error_log('products.php: Products data is not an array. Check database connection and query.');
                    $products = [
                        ["description" => "Demo product", "img" => "../images/demo.png"],
                    ];
                }

                ?>
                <section class="products box-shadow box-content" id="product-list">
                    <?php
                    foreach ($products as $p) {
                        $name = htmlspecialchars($p["name"]);
                        $info = htmlspecialchars($p["info"]);
                        $price = number_format($p["price"], 2, ',', '.');
                        $categorie_id = htmlspecialchars($p["categorie_id"]);
                        $productJson = htmlspecialchars(json_encode($p));
                        ?>
                        <product-item name="<?php echo $name; ?>" info="<?php echo $info; ?>" price="<?php echo $price; ?>"
                            categorie_id="<?php echo $categorie_id; ?>"
                            product="<?php echo $productJson; ?>"></product-item>
                        <?php
                    }
                    ?>

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