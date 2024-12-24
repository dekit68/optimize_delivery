<?php

require '../config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT COUNT(*) FROM food_type WHERE id = ?");
$stmt->execute([$id]);
$exists = $stmt->fetchColumn();

if ($exists) {
    $stmt = $pdo->prepare("DELETE FROM food_type WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode('Delete Successful!');
    header('location: /');
} else {
    echo json_encode('Shop Type not found');
    header('location: /');
}
?>