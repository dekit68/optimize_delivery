<?php

require '../config.php';
session_start();

if (isset($_POST['id']) && is_array($_POST['id'])) {
    $ids = $_POST['id'];
    try {
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, delivery_status, pay_status, time) VALUES (?, 0, 0, NOW())");
        $stmt->execute([$_SESSION['user_login']]);

        $order_id = $pdo->lastInsertId();
        foreach ($ids as $id) {
            if (is_numeric($id)) {
                $stmtCart = $pdo->prepare("SELECT * FROM cart WHERE id = ?");
                $stmtCart->execute([$id]);
                $cart = $stmtCart->fetch();

                if ($cart) {
                    $stmt = $pdo->prepare("INSERT INTO orders_detail (id, qty, price, total_price, shop_id, food_id, discount, time) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
                    $stmt->execute([$order_id, $cart['qty'], $cart['price'], $cart['total_price'] * $cart['qty'], $cart['shop_id'], $cart['food_id'], $cart['discount']]);

                    $stmtDelete = $pdo->prepare("DELETE FROM cart WHERE id = ?");
                    $stmtDelete->execute([$id]);
                } else {
                    echo json_encode("Cart item not found for ID: $id");
                    exit;
                }
            } else {
                echo json_encode("Invalid ID: $id");
                exit;
            }
        }
    } catch (PDOException $e) {
        echo json_encode("Error: " . $e->getMessage());
        exit;
    }

    echo json_encode('Payment Success!');
} else {
    echo json_encode('No valid IDs received');
}
?>
