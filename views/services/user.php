<?php
require 'db.php';
$stmt = $pdo->prepare("SELECT * FROM food");
$stmt->execute();
$food = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container">
        <?php include 'status.php'; ?>

        <div class="contents" id="menu">
            <h1>เมนู</h1>
            <?php foreach ($food as $data) {?>
                <h1><?= $data['name'] ?></h1>
            <?php } ?>
        </div>

        <div class="contents" id="cart">
            <h1>ตะกล้า</h1>
        </div>

        <?php include 'profile.php' ?>
    </div>
</body>
</html>