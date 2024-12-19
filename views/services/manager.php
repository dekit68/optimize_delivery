<?php
    require 'config.php';
    $users = fd('users', $pdo);
    $food_types = fd('food_type', $pdo);
    $foods = gwt('food', 'food_type', 'name', 'food_type_name', 'type_id', 'id',  $pdo);
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
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="food">เพิ่มรายการอาหาร</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="foodtype">เพิ่มหมวดหมู่อาหาร</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="shoptype">รายงานสรุปการขายเป็นวัน/เดือน/ปี</a></li>
                </ul>
            </div>
            <div class="col-md-10 my-4">
                <div class="container">
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
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            send('#createShop');
            sendwimg('createfood1');
        })
    </script>
</body>
</html>