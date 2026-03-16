<?php

include_once("loadDb.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputUsername = '';
    if(isset($_POST['name'])) {
        $inputUsername = $_POST['name'];
    }
    $inputPassword = '';
    if(isset($_POST['password'])) {
        $inputPassword = $_POST['password'];
    }

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