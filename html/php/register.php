<?php

include_once "loadDb.php";

$name = $_POST["name"];
$password = $_POST["password"];

$isAdmin = 0;
if (isset($_POST["isAdmin"]) && $_POST["isAdmin"] === "true") {
    $isAdmin = 1;
}

$stmt = $pdo->query("SELECT * FROM user");
$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($user as $usr) {
    if ($usr["password"] === $password && $usr["name"] === $name) {
        echo json_encode(['success' => false, 'message' => 'password and username already already in use']);
        exit;
    }

}

try {
    $sql = "INSERT INTO user (name, password, isAdmin) VALUES (:name, :password , :isAdmin)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":password", $password, PDO::PARAM_STR);
    $stmt->bindParam(":isAdmin", $isAdmin, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'message' => 'user added']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'error ' . $e->getMessage()]);
}


?>