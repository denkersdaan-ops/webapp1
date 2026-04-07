<?php
session_start();

if(isset($_POST['logout']) && $_POST['logout'] == 'true') {
     session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
include_once("php/loadDB.php");
include 'php/loginCheck.php';   

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastfood admin</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php
    include_once("phpAsHtml/header.php");
    ?>

    <?php include_once("phpAsHtml/login-register.php"); ?>

    <main class="admin-main stripe-shadow">
        <div class="admin-content box-content box-shadow">
            <h1>Admin Panel</h1>
            <div class="sections">
                <div class="stripe-shadow stripe-maximal">
                    <div class="admin-section box-content box-shadow">
                        <h2>Categories</h2>
                        <div class="stripe-shadow margin-container">
                            <button id="add-category-btn" onclick='addMode("add-category")'
                                class="admin-btn box-content box-shadow">Add category
                            </button>
                        </div>
                        <div class="stripe-shadow margin-container">
                            <button id="Change-category-btn" onclick='changeMode("change-category")'
                                class="admin-btn box-content box-shadow">Change category
                            </button>
                        </div>
                        <div class="stripe-shadow margin-container">
                            <button id="Remove-category-btn" onclick='removeMode("remove-category")'
                                class="admin-btn box-content box-shadow">Remove category
                            </button>
                        </div>
                        <div class="stripe-shadow margin-container list-container">
                            <div id="categories-list" class="box-content box-shadow">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM category");
                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($categories as $category) {
                                    ?>
                                    <div>
                                        <input type="submit" class="submit-btn" id="category-<?= $category['id']; ?>" name="category"
                                            value="<?= "Name: " . htmlspecialchars($category['name']); ?>">
                                    </div><?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stripe-shadow stripe-maximal">
                    <div class="admin-section box-content box-shadow">
                        <h2> Product</h2>

                        <div class="stripe-shadow margin-container">
                            <button id="add-product-btn" onclick='addMode("add-product")'
                                class="admin-btn box-content box-shadow">Add
                                product</button>
                        </div>
                        <div class="stripe-shadow margin-container">
                            <button id="Change-product-btn" onclick='changeMode("change-product")'
                                class="admin-btn box-content box-shadow">Change
                                product</button>
                        </div>
                        <div class="stripe-shadow margin-container">
                            <button id="Remove-product-btn" onclick='addMode("remove-product")'
                                class="admin-btn box-content box-shadow">Remove
                                product</button>
                        </div>
                        <div class="stripe-shadow margin-container list-container">
                            <div id="products-list" class="box-content box-shadow">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM product ORDER by id desc");
                                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($products as $product) {
                                    ?>
                                    <div>
                                        <input type="submit" class="submit-btn" id="product-<?= $product['id']; ?>" name="product"
                                            value="<?= "Name: " . htmlspecialchars($product['name']); ?>">
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
</body>

<script src="js/admin.js"></script> <!-- after the php so the items exist.