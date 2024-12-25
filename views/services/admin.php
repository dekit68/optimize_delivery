<?php
require 'db.php';
$stmt = $pdo->prepare("SELECT * FROM users WHERE role = ?");
$stmt->execute(['user']);
$user = $stmt->fetchAll();

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
    <?php include 'navbar.php' ?>
    <div class="container">
        <?php include 'status.php'; ?>

        <div class="contents" id="user">

        </div>

        <div class="contents" id="manager">
        
        </div>
        
        <div class="contents" id="delivery">
        
        </div>

        <div class="contents" id="food_type">
            <div class="mt-3">
                <h1>จัดการประเภทร้านอาหาร</h1>              
                <button class="mb-3 btn btn-primary">เพิ่มประเภทร้านอาหาร</button>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="search" placeholder="ss">
                    <label>ค้นหาข้อมูล...</label>
                </div>
            
                <table class="table table-hover table-striped table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>ประเภทร้านอาหาร</th>
                            <th class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($shop_type as $data) :?>
                            <th><?= $data['name'] ?></th>
                            <th class="text-center">
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> ลบ
                                </button>
                            </th>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="contents" id="shop">

        </div>



        <?php include 'profile.php' ?>
    </div>

    <script>
        (() => {
        'use strict'
            document.querySelector('#navbarSideCollapse').addEventListener('click', () => {
            document.querySelector('.offcanvas-collapse').classList.toggle('open')
            })
        })()
    </script>
</body>
</html>