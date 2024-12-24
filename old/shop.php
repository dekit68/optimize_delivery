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

$stmt = $pdo->prepare("SELECT shop.*, shop_type.name AS shop_type_name, CONCAT(users.firstname, ' ', users.lastname) AS username, users.profile_image AS user_img FROM shop INNER JOIN shop_type ON shop.type_id = shop_type.id INNER JOIN users ON shop.user_id = users.id WHERE shop.id = ?");
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
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-light">
                        <h2 class="mb-0"><?= $data['name'] ?></h2>
                    </div>

                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12 col-md-4 mt-3 d-flex flex-column align-items-center">
                                <h5 class="me-2 text-dark fw-bold">ผู้จัดการร้าน</h5>
                                <img src="<?= $data['user_img'] ?>" alt="User Image" class="img-fluid rounded-circle mb-2" style="max-width: 150px;">
                                <p class="lead text-secondary"><?= $data['username'] ?></p>
                            </div>

                            <div class="col-12 col-md-5 mt-5">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <h5 class="me-2 text-dark fw-bold">ชื่อร้าน</h5>
                                        <p class="lead text-secondary"><?= $data['name'] ?></p>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <h5 class="me-2 text-dark fw-bold">ประเภทร้านอาหาร</h5>
                                        <p class="lead text-secondary"><?= $data['shop_type_name'] ?></p>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <h5 class="me-2 text-dark fw-bold">ที่อยู่</h5>
                                        <p class="lead text-secondary"><?= $data['address'] ?></p>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <h5 class="me-2 text-dark fw-bold">เบอร์โทรร้าน</h5>
                                        <p class="lead text-secondary"><?= $data['phone'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-1 col-md-3 mt-5">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <h5 class="me-2 text-dark fw-bold">อาหารทั้งหมด</h5>
                                        <p class="lead text-secondary"> 2 รายการ </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>