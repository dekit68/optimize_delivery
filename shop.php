<?php

require 'config.php';
include 'assets.php';
session_start();
$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT COUNT(*) AS cart_count FROM cart WHERE user_id = ?');
$stmt->execute([$_SESSION['user_login']]);
$cartData = $stmt->fetch();
$cartCount = $cartData['cart_count'] ?? 0;

$stmt = $pdo->prepare("SELECT shop.*, shop_type.name AS shop_type_name FROM shop INNER JOIN shop_type ON shop.type_id = shop_type.id WHERE shop.id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้าน | <?= $data['name'] ?></title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <?= $data['name'] ?>
    <?= $data['shop_type_name'] ?>
    <?= $data['address'] ?>
    <?= $data['phone'] ?>
</body>
</html>