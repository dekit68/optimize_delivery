<?php
require '../config.php';
session_start();

$id = $_POST['id'];
$uid = $_SESSION['user_login'];

$stmt = $pdo->prepare("SELECT food.*, ft.shop_id FROM food AS food JOIN food_type AS ft ON food.type_id = ft.id WHERE food.id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

try {
    $stmt = $pdo->prepare("SELECT qty FROM cart WHERE food_id = ? AND user_id = ?");
    $stmt->execute([$id, $uid]);
    $ex = $stmt->fetchColumn();

    if ($ex) {
        $newQty = $ex + 1;
        $stmt = $pdo->prepare("UPDATE cart SET qty = ? WHERE food_id = ? AND user_id = ?");
        $stmt->execute([$newQty, $id, $uid]);
        echo json_encode('Item quantity updated');
        header('location: /');  
    } else {
        $totalPrice = $data['price'] - $data['discount'];
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, food_id, qty, name, price, food_img, discount, total_price, shop_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$uid, $id, 1, $data['name'], $data['price'], $data['food_img'], $data['discount'], $totalPrice, $data['shop_id']]);
        echo json_encode('Item added to cart');
        header('location: /');
    }
} catch (PDOException $e) {
    echo json_encode($e->getMessage());
}
?>
