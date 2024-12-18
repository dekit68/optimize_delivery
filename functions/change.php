<?php
session_start();
require '../config.php';

$password = $_POST['op'];
$new_password = $_POST['np'];

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_login']]);
    $row = $stmt->fetch();
    if ($row['password'] !== $new_password) {
        try {
            $stmt = $pdo->prepare("");
        } catch (PDOException $e) {
            echo json_encode($e -> getMessage());
        }
    } else {
        echo json_encode("Invalid credentials");
    }
} catch (PDOException $e) {
    echo json_encode("Invalid credentials");
}


?>