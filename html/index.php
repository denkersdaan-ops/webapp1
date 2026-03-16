<?php
session_start();

include_once("php/loadDB.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastfood</title>
    <link rel="stylesheet" href="css/styles.css">

    <script src="js/sort.js"></script>
    <script src="js/defer.js"></script>
    <script src="js/shopingcart.js"></script>
    <script src="js/login.js"></script>
</head>

<body>

    <?php
   include_once("phpAsHtml/header.php");
   ?>

        <!-- LOGIN MODAL -->
    <div id="login-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Log In</h2>
            <form id="login-form">
                <label for="username">Username:</label>
                <input type="text" maxlength="40" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" maxlength="40" id="password" name="password" required>
                <button type="submit">Log In</button>
            </form>
        </div>
    </div>

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
            <!-- categoryËN -->
            <div class="stripe-shadow rounded">
                <?php
                $stmt = $pdo->query("SELECT * FROM category ORDER BY id");
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);


                if (!$stmt) {
                    $error = $pdo->errorInfo();
                    die("Query-fout: " . $error[2]);
                }

                if (!is_array($categories)) {
                    error_log('categories.php: categories data is not an array. Check database connection and query.');
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
                        <div class="stripe-shadow rounded stripe-minimal"> <button id="<?php echo $id; ?>" onclick="setcategories(this.id)"
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
                $stmt = $pdo->query("SELECT * FROM product ORDER BY category_id");
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
                        $category_id = htmlspecialchars($p["category_id"]);
                        $productJson = htmlspecialchars(json_encode($p));
                        ?>
                        <product-item name="<?php echo $name; ?>" info="<?php echo $info; ?>" price="<?php echo $price; ?>"
                            category_id="<?php echo $category_id; ?>"
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