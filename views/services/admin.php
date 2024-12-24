<?php

require 'db.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE role = ?");
$stmt->execute(['delivery']);
$delivery = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM shop_type");
$stmt->execute();
$shop_type = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>

    <div class="contents" id="shoptype">
        <h1>จัดการประเภทร้านอาหาร</h1>
        <button class="btn btn-primary">
            เพิ่มประเภทร้านอาหาร
        </button>
        <?php
            foreach ($shop_type as $data):
        ?>
        <?= $data['name']?>

        <button class="btn btn-danger">Delete</button>
        <?php
            endforeach
        ?>


    </div>

    <div class="contents" id="delivery">
        <h1>จัดการผู้ส่งอาหาร</h1>
        <?php
            foreach ($delivery as $data):
        ?>
        <?= $data['fname']. " " . $data['lname'] ?>

        <button class="btn btn-primary">Disable</button>
        <?php
            endforeach
        ?>


    </div>

</body>
</html>