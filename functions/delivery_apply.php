<?php

require '../config.php';
session_start();
$id = $_POST['id'];

try {
    $stmt = $pdo->prepare("UPDATE orders SET delivery_id = ? WHERE id = ?");
    $stmt->execute([$_SESSION['user_login'], $id]);
    echo json_encode('Success!!!');
} catch (PDOException $e) {
    echo json_encode($e->getMessage());
}



?>