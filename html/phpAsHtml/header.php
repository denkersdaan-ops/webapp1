 <header class="header">

        <!-- LOGO -->
        <div class="stripe-shadow">
            <div class="logo box-shadow box-content">FASTFOOD</div>
        </div>

        <!-- NAV -->
        <nav class="header-nav">
            <div class="stripe-shadow nav">
                <a id="login-link" class="box-shadow box-content" href="#">Login</a>
            </div>
            <div class="stripe-shadow nav">
                <a class="box-shadow box-content" href="index.php">Home</a>
            </div>
            <div class="stripe-shadow nav">
                <a class="box-shadow box-content" href="menu.php">Menu</a>
            </div>
            <div class="stripe-shadow nav">
                <a class="box-shadow box-content" href="contact.php">Contact</a>
            </div>
            <?php
            if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) {
                echo '<div class="stripe-shadow nav">
                            <a class="box-shadow box-content" href="admin.php">Admin</a>
                          </div>';
            }
            ?>
        </nav>

    </header>