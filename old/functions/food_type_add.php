<?php
require '../config.php';
session_start();
$name = $_POST['name'];

try {
    $stmt = $pdo->prepare("SELECT * FROM shop WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_login']]);
    $data = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM food_type WHERE name = ? AND shop_id = ?");
    $stmt->execute([$name, $data['id']]);
    $nameEx = $stmt->fetchColumn();
    if ($nameEx) {
        echo json_encode("มีอยู่แล้ว");
    } else {
        $stmt = $pdo->prepare("INSERT INTO food_type (name, shop_id) VALUES (?, ?)");
        $stmt->execute([$name, $data['id']]);
        echo json_encode('Success!!');
    }
} catch (PDOException $e) {
    echo json_encode($e->getMessage());
}

?>
