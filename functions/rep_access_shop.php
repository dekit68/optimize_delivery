<?php

require '../config.php';
$id = $_GET['id'];
$action = $_GET['action'];

try {
    if ($action === "enable") {
        $stmt = $pdo->prepare("UPDATE shop SET approve=1 WHERE id= ?");
        $stmt->execute([$id]);
        echo json_encode('Success!!');
        header('location: /');
    } else {
        $stmt = $pdo->prepare("UPDATE shop SET approve=0 WHERE id= ?");
        $stmt->execute([$id]);
        echo json_encode('Success!!');
        header('location: /');
    }
} catch (PDOException $e) {
    echo json_encode($e->getMessage());
}

?>