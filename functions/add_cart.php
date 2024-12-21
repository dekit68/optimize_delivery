<?php
require '../config.php';
session_start();

$id = $_POST['id'];
$uid = $_SESSION['user_login'];
$qtyy= $_POST['qty'];

$stmt = $pdo->prepare("SELECT * FROM food WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

try {
    $stmt = $pdo->prepare("SELECT qty FROM cart WHERE food_id = ? AND user_id = ?");
    $stmt->execute([$id, $uid]);
    $ex = $stmt->fetchColumn();

    if ($ex) {
        $newQty = $qtyy + 1;
        $stmt = $pdo->prepare("UPDATE cart SET qty = ? WHERE food_id = ? AND user_id = ?");
        $stmt->execute([$newQty, $id, $uid]);
        echo json_encode('Item quantity updated');
        header('location: /');  
    } else {
        $totalPrice = $data['price'] - $data['discount'];
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, food_id, qty, name, price, food_img, discount, total_price, shop_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$uid, $id, $qtyy, $data['name'], $data['price'], $data['food_img'], $data['discount'], $totalPrice, $data['shop_id']]);
        echo json_encode('Item added to cart');
        header('location: /');
    }
} catch (PDOException $e) {
    echo json_encode($e->getMessage());
}
?>
