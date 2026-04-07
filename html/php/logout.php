<?php
if(isset($_POST['logout']) && $_POST['logout'] == 'true') {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
