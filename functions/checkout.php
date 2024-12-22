<?php

require '../config.php';
session_start();

if (isset($_POST['id']) && is_array($_POST['id'])) {
    $ids = $_POST['id'];
    try {

        $stmtCart = $pdo->prepare("SELECT * FROM cart WHERE id IN (" . implode(',', array_fill(0, count($ids), '?')) . ")");
        $stmtCart->execute($ids);
        $cartItems = $stmtCart->fetchAll();

        $groupedItems = [];

        foreach ($cartItems as $item) {
            $groupedItems[$item['shop_id']][] = $item;
        }

        $existingOrders = [];

        foreach (array_keys($groupedItems) as $shop_id) {
            $stmtCheckOrder = $pdo->prepare("SELECT id FROM orders WHERE user_id = ? AND shop_id = ? AND delivery_status = 0");
            $stmtCheckOrder->execute([$_SESSION['user_login'], $shop_id]);
            $existingOrder = $stmtCheckOrder->fetch();
            if ($existingOrder) {
                $existingOrders[$shop_id] = $existingOrder['id'];
            }
        }

        foreach ($groupedItems as $shop_id => $items) {
            if (isset($existingOrders[$shop_id])) {
                echo json_encode("รายการที่แล้วยังไม่สำเร็จสำหรับร้านนี้");
                exit; 
            }

            $stmtOrder = $pdo->prepare("INSERT INTO orders (user_id, delivery_status, shop_id, time) VALUES (?, 0, ?, NOW())");
            $stmtOrder->execute([$_SESSION['user_login'], $shop_id]);
            $order_id = $pdo->lastInsertId();

            foreach ($items as $item) {
                $stmtDetail = $pdo->prepare("INSERT INTO orders_detail (id, qty, price, total_price, food_id, discount) VALUES (?, ?, ?, ?, ?, ?)");
                $stmtDetail->execute([
                    $order_id,
                    $item['qty'],
                    $item['price'],
                    $item['total_price'] * $item['qty'],
                    $item['food_id'],
                    $item['discount']
                ]);

                $stmtDelete = $pdo->prepare("DELETE FROM cart WHERE id = ?");
                $stmtDelete->execute([$item['id']]);
            }
        }

        echo json_encode("success");
    } catch (PDOException $e) {
        echo json_encode("Error: " . $e->getMessage());
        exit;
    }
} else {
    echo json_encode('No valid IDs received');
}
?>
