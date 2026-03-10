<?php

$host = "db";              // de Docker service-naam!
$dbname = "mydatabase";    // uit jouw docker-compose
$username = "user";        // MYSQL_USER
$password = "password";    // MYSQL_PASSWORD

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database fout']);
    exit;
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'] ?? '';
    $inputPassword = $_POST['password'] ?? '';

    if (empty($inputUsername) || empty($inputPassword)) {
        echo json_encode(['success' => false, 'message' => 'Vul alle velden in']);
        exit;
    }

    try {
        // Check if user exists and password matches (assuming plain text for now)
        $stmt = $pdo->prepare("SELECT * FROM user WHERE name = ? AND password = ?");
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Query prepare fout']);
            exit;
        }
        $stmt->execute([$inputUsername, $inputPassword]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Login successful
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['isAdmin'] = $user['isAdmin'];
            echo json_encode(['success' => true, 'message' => 'Login succesvol']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ongeldige credentials']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database query fout: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>