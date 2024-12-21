<?php

require 'config.php';
include 'assets.php';
session_start();
ProtectRoute();
$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT COUNT(*) AS cart_count FROM cart WHERE user_id = ?');
$stmt->execute([$_SESSION['user_login']]);
$cartData = $stmt->fetch();
$cartCount = $cartData['cart_count'] ?? 0;

$stmt = $pdo->prepare("SELECT shop.*, shop_type.name AS shop_type_name, CONCAT(users.firstname, ' ', users.lastname) AS username FROM shop INNER JOIN shop_type ON shop.type_id = shop_type.id INNER JOIN users ON shop.user_id = users.id WHERE shop.id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้าน | <?= $data['name'] ?></title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-light">
                        <h2><?= $data['name'] ?></h2>
                    </div>

                    <div class="card-body bg-light">
                            <div class="row m-4">
                                <div class="col-sm-12 col-md-12 mt-1 mb-2 border-detail">
                                    <h5 class="me-2 text-dark fw-bold">ผู้จัดการร้าน</h5>
                                    <p class="lead text-secondary"><?= $data['username'] ?></p>
                                </div>

                                <div class="col-md-6 mb-1">
                                    <h5 class="me-2 text-dark fw-bold">ชื่อร้าน</h5>
                                    <p class="lead text-secondary"><?= $data['name'] ?></p>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="me-2 text-dark fw-bold">ประเภทร้านอาหาร</h5>
                                    <p class="lead text-secondary"><?= $data['shop_type_name'] ?></p>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="me-2 text-dark fw-bold">ที่อยู่</h5>
                                    <p class="lead text-secondary"><?= $data['address'] ?></p>
                                </div>

                                <div class="col-md-6 mb-1">
                                    <h5 class="me-2 text-dark fw-bold">เบอร์โทรร้าน</h5>
                                    <p class="lead text-secondary"><?= $data['phone'] ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>