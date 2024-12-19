<?php
    require 'config.php';
    $foods = gwt('food', 'food_type', 'name', 'food_type_name', 'type_id', 'id',  $pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="menu">เมนูอาหาร</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="history">ประวัติการสั่งอาหาร</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="shop">ร้านอาหารทั้งหมด</a></li>
                </ul>
            </div>
            <div class="col-md-10 my-4">
                <div class="container">
                    <div class="contents" id="menu">
                        <div class="container mt-5">
                            <h1 class="text-center mb-4">เมนู</h1>

                            <div class="row">
                                <?php foreach ($foods as $food): ?>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="<?= $food['food_img']; ?>" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $food['name']; ?></h5>
                                            <p class="card-text"><?= $food['food_type_name']; ?></p>
                                            <p class="card-text"><strong>ราคา: <?= number_format($food['price'], 2); ?>บาท</strong></p>
                                            <form action="functions/add_cart.php" method="post">
                                                <input type="hidden" name="id" value="<?= $food['id'] ?>">
                                                <button type="submit" class="btn btn-primary">เลือกลงตะกล้า</button>
                                            </form>
                                           
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="contents" id="history">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3>History</h3>
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

                    <div class="contents" id="shop">
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
                                                <form action="functions/shop_type_delete.php" method="get"
                                                    onsubmit="return confirmDelete('shop type');">
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

</body>

</html>