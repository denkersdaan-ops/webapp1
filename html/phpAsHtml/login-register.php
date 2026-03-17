<script src="js/login-register.js"></script>

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
        <button onclick="register()">Register</button>
    </div>
</div>

<!-- register MODAL -->
<div id="register-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Register</h2>
        <form id="register-form">
            Username:<input type="text" id="register-username" maxlength="40" required>
            Password:<input type="password" id="register-password" maxlength="40" required>
            verify Password:<input type="password" id="verify-password" maxlength="40" required>
            <?php
            if ($_SESSION["isAdmin"] == 1) {
                ?>
                is admin:<input type="checkbox" id="isAdmin" name="isAdmin">
                <?php
            }
            ?>
            <button type="submit">Register</button>
        </form>
    </div>
</div>