<?php

require '../config.php';

$id = $_POST['id'];

try {
    $stmt = $pdo->prepare("UPDATE orders SET delivery_status = 1 WHERE id = ?");
    $stmt->execute([$id]);
    header('location: /');
} catch (PDOException $e) {
    echo $e->getMessage();
}



?>