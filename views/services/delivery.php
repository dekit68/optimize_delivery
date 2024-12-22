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

    $stmt = $pdo->prepare('SELECT orders.*, CONCAT(users.firstname, " ", users.lastname) AS username, users.address AS address, shop.name AS shopname FROM orders INNER JOIN users ON users.id = orders.user_id INNER JOIN shop ON shop.id = orders.shop_id WHERE delivery_id IS NULL');
    $stmt->execute();
    $orders = $stmt->fetchAll();

    $order_detail = [];
    $stmt = $pdo->prepare('SELECT orders_detail.*, food.name AS foodname FROM orders_detail INNER JOIN food ON food.id = orders_detail.food_id WHERE orders_detail.id = ?');
    foreach ($orders as $order) {
        $stmt->execute([$order['id']]);
        $order_detail[$order['id']] = $stmt->fetchAll();
    }

    $stmt = $pdo->prepare('SELECT orders.*, CONCAT(users.firstname, " ", users.lastname) AS username, users.address AS address, shop.name AS shopname FROM orders INNER JOIN users ON users.id = orders.user_id INNER JOIN shop ON shop.id = orders.shop_id WHERE delivery_id = ? AND delivery_status=0');
    $stmt->execute([$_SESSION['user_login']]);
    $orders_apply = $stmt->fetchAll();

    $order_details = [];
    $stmt = $pdo->prepare('SELECT orders_detail.*, food.name AS foodname FROM orders_detail INNER JOIN food ON food.id = orders_detail.food_id WHERE orders_detail.id = ?');
    foreach ($orders_apply as $order) {
        $stmt->execute([$order['id']]);
        $order_details[$order['id']] = $stmt->fetchAll();
    }

    $stmt = $pdo->prepare('SELECT orders.*, CONCAT(users.firstname, " ", users.lastname) AS username, users.address AS address, shop.name AS shopname FROM orders INNER JOIN users ON users.id = orders.user_id INNER JOIN shop ON shop.id = orders.shop_id WHERE delivery_id = ? AND delivery_status = 1');
    $stmt->execute([$_SESSION['user_login']]);
    $order_success = $stmt->fetchAll();

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
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="orders_apply">รายการอาหารที่รับแล้ว</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="paymented">รายงานสรุปการขายเป็นวัน/เดือน/ปี</a></li>
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
                            <table id="admin-table" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>เวลา</th>
                                        <th>ลูกค้า</th>
                                        <th>ร้าน</th>
                                        <th>ที่อยู่</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td><?= $order['id']; ?></td>
                                        <td><?= $order['time']; ?></td>
                                        <td><?= $order['username']; ?></td>
                                        <td><?= $order['shopname']; ?></td>
                                        <td><?= $order['address']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#delivery_detail-<?= $order['id'] ?>">
                                                รายระเอียด
                                            </button>

                                            <form action="functions/delivery_apply.php" method="post" onsubmit="return confirm('รับงานเลยไหม');">
                                                <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                                <button type="submit" class="btn btn-warning">รับ</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="delivery_detail-<?= $order['id'] ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Order Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php foreach ($order_detail[$order['id']] as $ordetail): ?>
                                                        <p><?= $ordetail['foodname']. " ". $ordetail['price']. " ". $ordetail['discount'] ?></p>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                    <div class="contents" id="orders_apply">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3>Orders Apply</h3>
                            </div>
                            <div class="card-body">
                                <table id="admin-table" class="table table-bordered table-striped ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Time</th>
                                            <th>Emp</th>
                                            <th>Address</th>
                                            <th>ShopName</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders_apply as $orders): ?>
                                        <tr>
                                            <td>
                                                <?= $orders['id']; ?>
                                            </td>
                                            <td>
                                                <?= $orders['time']; ?>
                                            </td>
                                            <td>
                                                <?= $orders['username']; ?>
                                            </td>
                                            <td>
                                                <?= $orders['address']; ?>
                                            </td>
                                            <td>
                                                <?= $orders['shopname']; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#delivery_detail-<?= $orders['id'] ?>">
                                                    รายระเอียด
                                                </button>
                                                <form action="functions/delivery_status.php" method="post" onsubmit="return confirm('ยืนยัน');">
                                                    <input type="hidden" name="id" value="<?= $orders['id'] ?>">
                                                    <button type="submit" class="btn btn-warning">ส่งแล้ว/ชำระเงินแล้ว</button>
                                                </form> 
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="delivery_detail-<?= $orders['id'] ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Order Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php foreach ($order_details[$orders['id']] as $ordetail): ?>
                                                            <p><?= $ordetail['foodname']. " ". $ordetail['price']. " ". $ordetail['discount'] ?></p>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="contents" id="paymented">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3>Paymented</h3>
                            </div>
                            <div class="card-body">
                                <table id="admin-table" class="table table-bordered table-striped ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Time</th>
                                            <th>Emp</th>
                                            <th>Address</th>
                                            <th>ShopName</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order_success as $orders): ?>
                                        <tr>
                                            <td>
                                                <?= $orders['id']; ?>
                                            </td>
                                            <td>
                                                <?= $orders['time']; ?>
                                            </td>
                                            <td>
                                                <?= $orders['username']; ?>
                                            </td>
                                            <td>
                                                <?= $orders['address']; ?>
                                            </td>
                                            <td>
                                                <?= $orders['shopname']; ?>
                                            </td>
                                            <td>
                                                <form action="bill.php" method="get">
                                                    <input type="hidden" name="id" value="<?= $orders['id'] ?>">
                                                    <button type="submit" class="btn btn-warning">พิมพ์ใบเสร็จ</button>
                                                </form> 
                                            </td>

                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <?php include 'profile.php'; ?>
            
                </div>
            </div>
        </div>
    </div>
</body>
</html>