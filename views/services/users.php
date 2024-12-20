<?php
    require 'config.php';
    $stmt=$pdo->prepare('SELECT food.*, food_type.name AS food_type_name, shop.name AS shop_name FROM food INNER JOIN food_type ON food.type_id = food_type.id INNER JOIN shop ON food.shop_id = shop.id');
    $stmt->execute();
    $foods = $stmt->fetchAll();

    $stmt = $pdo->prepare('SELECT COUNT(*) AS cart_count FROM cart WHERE user_id = ?');
    $stmt->execute([$_SESSION['user_login']]);
    $cartData = $stmt->fetch();
    $cartCount = $cartData['cart_count'] ?? 0;


    $stmt=$pdo->prepare('SELECT cart.*, shop.name AS shop_name FROM cart INNER JOIN shop ON cart.shop_id = shop.id');
    $stmt->execute();
    $carts = $stmt->fetchAll();

    $stmt=$pdo->prepare('SELECT shop.*, shop_type.name AS shop_type_name FROM shop INNER JOIN shop_type ON shop.type_id = shop_type.id');
    $stmt->execute();
    $shops = $stmt->fetchAll();

    $stmt = $pdo->prepare('SELECT orders.*, shop.name AS shop_name FROM orders LEFT JOIN shop ON orders.shop_id = shop.id WHERE orders.user_id = ?');
    $stmt->execute([$_SESSION['user_login']]);
    $datahistory = $stmt->fetchAll();
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
                                            <p class="card-text"><?= $food['food_type_name'] . ' - ' ?> <a href="shop.php?id=<?= $food['shop_id'] ?>"><?= $food['shop_name'] ?></a></p>
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
                                            <th>time</th>
                                            <th>price</th>
                                            <th>shop</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($datahistory as $data): ?>
                                        <tr>
                                            <td>
                                                <?php echo $data['id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['time']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['price']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['shop_name']; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning" onclick="">View</button>
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
                                                <button class="btn btn-danger" onclick="">Views</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="contents" id="cart">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                            <?php foreach ($carts as $cart): ?>
                                <h3>Cart</h3>
                                <p>รวมทั้งหมด: <?= $cart['total_price'] * $cart['qty'] ?></p>
                                <button class="btn btn-primary">Pay</button>
                            </div>
                            <div class="card-body">
                                <table id="admin-table" class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Img</th>
                                            <th>Name</th>
                                            <th>ShopName</th>
                                            <th>Qty</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $cart['id']; ?>
                                            </td>
                                            <td>
                                                <img src="<?= $cart['food_img'] ?>" alt="">
                                            </td>
                                            <td>
                                                <?php echo $cart['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $cart['shop_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $cart['qty']; ?>
                                            </td>
                                            <td>
                                                <form action="functions/delete_cart.php" method="get" onsubmit="return confirm('ลบเลยนะ')">
                                                    <input type="hidden" name="id" value="<?= $cart['id'] ?>">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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