<?php
    require 'config.php';

    $users = fd('users', $pdo);
    $shop_types = fd('shop_type', $pdo);
    $food_types = fd('food_type', $pdo);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_login']]);
    $user = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT shop.*, shop_type.name AS shop_type_name FROM shop JOIN shop_type ON shop.type_id = shop_type.id WHERE shop.user_id = ?");
    $stmt->execute([$_SESSION['user_login']]);
    $datashop = $stmt->fetch();
    $uhs = $datashop ? true : false;

    $stmt = $pdo->prepare('SELECT orders.*, CONCAT(users.firstname, " ", users.lastname) AS username FROM orders INNER JOIN users ON orders.user_id = users.id WHERE delivery_id IS NULL');
    $stmt->execute();
    $orders = $stmt->fetchAll();
    include 'modal.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery | Dashboard</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="orders">รับรายการอาหาร</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="orders">การอาหารที่รับแล้ว</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="paymented">รายการชำระเงินสำเร็จ</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="shoptype">รายงานสรุปการขายเป็นวัน/เดือน/ปี</a></li>
             
                </ul>
            </div>
            <div class="col-md-10 my-4">
                <div class="container">
        
               
                    <div class="contents" id="orders">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3>Orders</h3>
                            </div>
                            <div class="card-body">
                                <table id="admin-table" class="table table-bordered table-striped ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Time</th>
                                            <th>Emp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td>
                                                <?= $order['id']; ?>
                                            </td>
                                            <td>
                                                <?= $order['time']; ?>
                                            </td>
                                            <td>
                                                <?= $order['username']; ?>
                                            </td>
                                            <td>
                                                <form action="functions/delivery_apply.php" method="post" onsubmit="return confirm('รับงานเลยไหม');" id="apply_order">
                                                    <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                                    <button type="submit" class="btn btn-warning" >รับ</button>
                                                </form>
                                               
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
            
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            send('apply_order');
        })
    </script>
</body>
</html>