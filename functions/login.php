<?php
require 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $hashedPassword = $row['password'];
        if (password_verify($password, $hashedPassword)) {
            echo json_encode(array("status" => "success", "msg" => "Login successful!"));
            $_SESSION['user_login'] = $row['id'];
            $_SESSION['role'] = $row['role'];
        } else {
            echo json_encode(array("status" => "error", "msg" => "Invalid credentials"));
        }
    } else {
        echo json_encode(array("status" => "error", "msg" => "Invalid credentials"));
    }
} catch (PDOException $e) {
    echo json_encode(array("status" => "error", "msg" => "Invalid credentials"));
}


?>