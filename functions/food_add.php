<?php

require '../config.php';

$name = $_POST['name'];
$type = $_POST['type'];
$price = $_POST['price'];
$discount = $_POST['discount'];
$food_image = null;

if (isset($_FILES['food_image']) && $_FILES['food_image']['error'] == 0) {
    $newFileName = time() . '_' . $_FILES['food_image']['name'];
    $food_image = '../uploads/food/' . $newFileName;
    move_uploaded_file($_FILES['food_image']['tmp_name'], $food_image);
}

try {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM food WHERE name = ?');
    $stmt->execute([$name]);
    $ex = $stmt->fetchColumn();
    if ($ex) {
        echo json_encode("มีอยู่แล้ว");
    } else {
        $stmt = $pdo->prepare('INSERT INTO food (name, type_id, price, discount, food_img) VALUES (?,?,?,?,?)');
        $stmt->execute([$name, $type, $price, $discount, $food_image]);
        echo json_encode("สำเร็จ");
    }
} catch (PDOException $e) {
    echo json_encode($e->getMessage());
}

?>