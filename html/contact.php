<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact — Fastfood</title>

    <link rel="stylesheet" href="css/styles.css">
    <script src="js/login.js"></script>
</head>

<body>

<?php include_once("phpAsHtml/header.php"); ?>

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

<main>

    <!-- HERO -->
    <div class="stripe-shadow">
        <section class="hero box-shadow box-content">
            <h1>Contact Us</h1>
            <p>We’d love to hear from you — questions, feedback or support.</p>
        </section>
    </div>

    <section class="layout">

        <!-- INFORMATION BLOCK -->
        <div class="stripe-shadow rounded">
            <section class="box-shadow box-content hero stripe-maximal contact-info">
                <h2>Reach Out</h2>
                <p class="contact-paragraph">
                    Our team is available throughout the week to help you out.
                </p>

                <div class="contact-details">
                    <p><strong>Email:</strong> contact@fastfood-demo.com</p>
                    <p><strong>Support:</strong> support@fastfood-demo.com</p>
                    <p><strong>Phone:</strong> +31 6 123 456 78</p>
                    <p><strong>Address:</strong> Demo Street 12, 1234 AB, Netherlands</p>
                </div>

                <hr class="contact-divider">

                <h3>Looking for something specific?</h3>
                <p class="contact-paragraph">
                    Check our menu to discover all categories and products.
                </p>

                <div class="stripe-shadow stripe-minimal contact-button-wrapper">
                    <button type="button" class="cta box-shadow box-content">
                        (Demo Only)
                    </button>
                </div>
            </section>
        </div>

        <!-- CONTACT FORM -->
        <div class="stripe-shadow rounded">
            <section class="box-shadow box-content hero stripe-maximal contact-form">
                <h2>Send Us a Message</h2>
                <p class="contact-note">This form is for demonstration purposes only.</p>

                <form>

                    <label>Name</label>

                    <input type="text" class="box-shadow contact-input" placeholder="Your name">

                    <label>Email</label>
                    <input type="email" class="box-shadow contact-input" placeholder="you@example.com">

                    <label>Subject</label>
                    <input type="text" class="box-shadow contact-input" placeholder="Subject">

                    <label>Message</label>
                    <textarea class="box-shadow contact-input contact-textarea" rows="6" placeholder="Write your message here..."></textarea>

                    <div class="stripe-shadow stripe-minimal contact-button-wrapper">
                        <button type="button" class="cta box-shadow box-content">
                            Send (Demo Only)
                        </button>
                    </div>
                </form>
            </section>
        </div>

    </section>

</main>

</body>
</html>