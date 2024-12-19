<?php
session_start();
require '../config.php';

$password = $_POST['op'];
$new_password = $_POST['np'];

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_login']]);
    $row = $stmt->fetch();
    if ($row['password'] !== $password) {
        echo json_encode("รหัสผ่านไม่ถูก!!!");
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE users SET password=? WHERE id=?");
            $stmt->execute([$new_password, $_SESSION['user_login']]);
            echo json_encode("Success!@!!");
        } catch (PDOException $e) {
            echo json_encode($e -> getMessage());
        }
    }
} catch (PDOException $e) {
    echo json_encode("Invalid credentials");
}


?>