<?php

include("loadDb.php");

$ids = explode(",", $_POST["ids"]);
$quantity = explode(",", $_POST["quantity"]);

$output = "";


for ($i = 0; $i < sizeof($ids); $i++) {

    $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");

    $stmt->bindParam(':id', $ids[$i], PDO::PARAM_INT);
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $currentBought = $row ? $row['bought'] : 0;
    $newBought = $currentBought + $quantity[$i];

    $sql = "UPDATE product SET bought = :bought WHERE id = :id";

    $bought += $quantity[$i];

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $ids[$i], PDO::PARAM_INT);
    $stmt->bindParam(':bought', $newBought, PDO::PARAM_INT);

    $stmt->execute();

}

exit;

?>