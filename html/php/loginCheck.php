<?php
if (!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] != 1) {
    header("Location: index.php");
    exit;
}
?>