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
</head>

<body>

    <?php
    include_once("phpAsHtml/header.php");
    ?>
    <?php include_once("phpAsHtml/login-register.php"); ?>

    <main>

        <!-- HERO / CALL TO ACTION -->
        <div class="stripe-shadow">
            <section class="hero box-shadow box-content">
                <h1>Fast, minimalist fast food.</h1>
                <p>Calm, simple, and stylish enjoyment.</p>

                <div class="stripe-shadow stripe-minimal">
                    <button class="cta box-shadow box-content" onclick="pay()">Order now</button>
                </div>

                <form action="menu.php" method="get">
                    <input type="text" name="search" placeholder="Search products...">
                    <button type="submit">Search</button>
                </form>
            </section>
        </div>

        <section class="layout">
            <!-- categories -->
            <div class="stripe-shadow item-1 rounded">
                <?php
                $stmt = $pdo->query("SELECT * FROM category ORDER BY id");
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);


                if (!$stmt) {
                    $error = $pdo->errorInfo();
                    die("Query error: " . $error[2]);
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
                        <div class="stripe-shadow rounded stripe-minimal"> <button id="<?= $id; ?>"
                                onclick="setCategories(this.id)" class="category box-shadow"><img class="category-icon"
                                    src="<?= $img; ?>" alt="<?= $description; ?>"></button></div>
                        <?php
                    }
                    ?>
                </aside>
            </div>

            <!-- PRODUCTS SCROLLBOX (may NOT get a shadow wrapper) -->
            <div class="stripe-shadow stripe-maximal item-2 rounded">
                <?php
                // Load all products - filtering happens in JavaScript
                $stmt = $pdo->prepare("SELECT * FROM product WHERE `name` LIKE :search ORDER BY category_id");

                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                $stmt->execute();

                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);


                if (!$stmt) {
                    $error = $pdo->errorInfo();
                    die("Query error: " . $error[2]);
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
                    if (empty($products)) {
                        echo "<p>No products found.</p>";
                    } else {
                        foreach ($products as $p) {
                            $name = htmlspecialchars($p["name"]);
                            $info = htmlspecialchars($p["info"]);
                            $price = number_format($p["price"], 2, ',', '.');
                            $category_id = htmlspecialchars($p["category_id"]);
                            $productJson = htmlspecialchars(json_encode($p));
                            ?>
                            <product-item name="<?= $name; ?>" info="<?= $info; ?>" price="<?= $price; ?>"
                                category_id="<?= $category_id; ?>" product="<?= $productJson; ?>"></product-item>
                            <?php
                        }
                    }
                    ?>

                </section>
            </div>
            <!-- CART -->
            <div class="stripe-shadow item-3 rounded">
                <aside class="cart box-shadow box-content">
                    <h3>Shopping cart</h3>
                    <p id="cart-items"></p>
                    <hr>
                    <p><strong id="total">Total:</strong></p>
                </aside>
            </div>
        </section>

    </main>
</body>

</html>