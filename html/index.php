<?php
session_start();
include_once("php/loadDB.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastfood — Home</title>

    <link rel="stylesheet" href="css/styles.css">
    <script src="js/login.js"></script>
</head>

<body>

    <?php include_once("phpAsHtml/header.php"); ?>

    <main>

        <!-- LOGIN MODAL -->
        <div id="login-modal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Log In</h2>
                <form id="login-form">
                    Username:<input type="text" id="username" maxlength="40" required>
                    Password:<input type="password" id="password" maxlength="40" required>
                    <button type="submit">Log In</button>
                </form>
            </div>
        </div>

        <!-- HERO -->
        <div class="stripe-shadow">
            <section class="hero box-shadow box-content">
                <h1>Fastfood, but calmer.</h1>
                <p>Minimalist, stylish and easy ordering.</p>

                <div class="stripe-shadow stripe-minimal">
                    <button class="cta box-shadow box-content" onclick="window.location.href='menu.php'">
                        Explore Menu
                    </button>
                </div>
            </section>
        </div>

        <!-- USP SECTION -->
        <section class="layout">

            <!-- LEFT -->
            <div class="stripe-shadow rounded">
                <section class="box-shadow box-content hero stripe-maximal info-block">
                    <h2>Why choose us?</h2>
                    <p>
                        We combine minimal design with fast service.
                        No noise, no clutter — just good food and a calm ordering experience.
                    </p>

                    <ul class="usp-list">
                        <li>✓ Super fast ordering</li>
                        <li>✓ Clean and simple interface</li>
                        <li>✓ Fresh ingredients, prepared with care</li>
                        <li>✓ Stylish and modern design</li>
                    </ul>
                </section>
            </div>

            <!-- RIGHT -->
            <div class="stripe-shadow rounded">
                <section class="box-shadow box-content hero stripe-maximal info-block">
                    <h2>About our concept</h2>
                    <p>
                        We believe fast food should not feel rushed or chaotic.
                        Our interface and design bring a calm, minimalist experience
                        to something that usually feels hectic.
                    </p>

                    <p class="extra-text">
                        Try it yourself — browse our categories and build your own meal
                        in a clean, distraction‑free environment.
                    </p>

                    <div class="stripe-shadow stripe-minimal">
                        <button class="cta box-shadow box-content" onclick="window.location.href='menu.php'">
                            Start Ordering
                        </button>
                    </div>
                </section>
            </div>

        </section>

    </main>

</body>

</html>