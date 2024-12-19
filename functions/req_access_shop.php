<?php

require '../config.php';
session_start();
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$type = $_POST['type'];

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM shop WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_login']]);
    $userEx = $stmt->fetchColumn();
    if ($userEx) {
        echo json_encode('User already registered a shop');
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM shop WHERE name = ?");
        $stmt->execute([$name]);
        $shopEx = $stmt->fetchColumn();
        if ($shopEx) {
            echo json_encode('Shop name already exists');
        } else {
            $stmt = $pdo->prepare("INSERT INTO shop (name, address, phone, type_id, user_id) VALUES (?,?,?,?,?)");
            $stmt->execute([$name, $address, $phone, $type, $_SESSION['user_login']]);
            echo json_encode('Success!!');
        }
    }
} catch (PDOException $e) {
    echo json_encode($e->getMessage());
}
?>