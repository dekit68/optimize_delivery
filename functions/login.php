<?php
session_start();
require '../config.php';

$email = $_POST['email'];
$password = $_POST['password'];

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        if ($password == $row['password']) {
            echo json_encode("Login successful!");
            $_SESSION['user_login'] = $row['id'];
            $_SESSION['role'] = $row['role'];
        } else {
            echo json_encode("Invalid credentials");
        }
    } else {
        echo json_encode("Invalid credentials");
    }
} catch (PDOException $e) {
    echo json_encode("Invalid credentials");
}


?>