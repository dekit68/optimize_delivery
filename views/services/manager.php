<?php
    require 'config.php';

    $users = fd('users', $pdo);
    $shop_types = fd('shop_type', $pdo);
    $food_types = fd('food_type', $pdo);

    $stmt = $pdo->prepare("SELECT shop.*, shop_type.name AS shop_type_name FROM shop JOIN shop_type ON shop.type_id = shop_type.id WHERE shop.user_id = ?");
    $stmt->execute([$_SESSION['user_login']]);
    $datashop = $stmt->fetch();
    $uhs = $datashop ? true : false;

    $stmt = $pdo->prepare('SELECT food.*, food_type.name AS food_type_name FROM food INNER JOIN food_type ON food.type_id = food_type.id');
    $stmt->execute();
    $foods = $stmt->fetchAll();
    include 'modal.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager | Dashboard</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <ul class="nav flex-column">
                    <?php 
                        if (empty($datashop['approve']) || $datashop['approve'] == 0) {
                    ?>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="access_shop">ขอใช้งานร้านอาหาร</a></li>
                    <?php    
                        } else {
                    ?>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="food">เพิ่มรายการอาหาร</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="foodtype">เพิ่มหมวดหมู่อาหาร</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="shoptype">รายงานสรุปการขายเป็นวัน/เดือน/ปี</a></li>
                    <?php      
                        }
                    ?>
                </ul>
            </div>
            <div class="col-md-10 my-4">
                <div class="container">
                    <?php 
                        if (empty($datashop['approve']) || $datashop['approve'] == 0) {
                    ?>
                    <div class="contents" id="access_shop">
                  
                        <h3>Access Shop</h3>
                        <?= ! $uhs ? '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#access_shopp">Request</button>' : '' ?>
                        <p>ชื่อร้าน <?= $datashop['name'] ?></p>
                        <p>ที่อยู่ <?= $datashop['address'] ?></p>
                        <p>เบอร์โทรร้าน <?= $datashop['phone'] ?></p>
                        <p>ประเภทร้านอาหาร <?= $datashop['shop_type_name'] ?></p>
                        
                    </div>
                    <?php    
                        } else {
                    ?>

                    <div class="contents" id="food">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3>Food</h3>
                                <button class="btn btn-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createfood">Create</button>
                            </div>
                            <div class="card-body">
                                <table id="admin-table" class="table table-bordered table-striped ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($foods as $food): ?>
                                        <tr>
                                            <td>
                                                <?php echo $food['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $food['food_type_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $food['price']; ?>
                                            </td>
                                            <td>
                                                <?= $food['discount']; ?>
                                            </td>
                                            <td>
                                                <img width="100px" src="<?= $food['food_img']; ?>" alt="">
                                            </td>
                                            <td>
                                                <button class="btn btn-warning" onclick="">Edit</button>
                                                <button class="btn btn-danger" onclick="">Delete</button>
                                            </td>

                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="contents" id="foodtype">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3>Shop</h3>
                            </div>
                            <div class="card-body">
                                <table id="admin-table" class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($shops as $shop): ?>
                                        <tr>
                                            <td>
                                                <?php echo $shop['id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $shop['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $shop['address']; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" onclick="">Delete</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="contents" id="shoptype">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3>Shoptype</h3>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createShopType">Create</button>
                            </div>
                            <div class="card-body">
                                <table id="admin-table" class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($shop_types as $shop_type): ?>
                                        <tr>
                                            <td>
                                                <?php echo $shop_type['id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $shop_type['name']; ?>
                                            </td>
                                            <td>
                                                <form action="functions/shop_type_delete.php" method="get" onsubmit="return confirmDelete('shop type');">
                                                    <input type="hidden" name="id" value="<?= $shop_type['id']; ?>">
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php      
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            send('createShop');
            send('createfood1');
            send('reqshop');
        })
    </script>
</body>
</html>