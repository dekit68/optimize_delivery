<?php
require '../config.php';
$name = $_POST['name'];

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM shop_type WHERE name = ?");
    $stmt->execute([$name]);
    $nameEx = $stmt->fetchColumn();
    if ($nameEx) {
        echo json_encode("มีอยู่แล้ว");
    } else {
        $stmt = $pdo->prepare("INSERT INTO shop_type (name) VALUES (?)");
        $stmt->execute([$name]);
        echo json_encode('Success!!');
    }
} catch (PDOException $e) {
    echo json_encode($e->getMessage());
}

?>
