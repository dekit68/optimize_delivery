<?php
    require 'config.php';

    $stmt=$pdo->prepare('SELECT food.*, food_type.name AS food_type_name, shop.name AS shop_name FROM food INNER JOIN food_type ON food.type_id = food_type.id INNER JOIN shop ON food.shop_id = shop.id');
    $stmt->execute();
    $foods = $stmt->fetchAll();

    $stmt = $pdo->prepare('SELECT COUNT(*) AS cart_count FROM cart WHERE user_id = ?');
    $stmt->execute([$_SESSION['user_login']]);
    $cartData = $stmt->fetch();
    $cartCount = $cartData['cart_count'] ?? 0;

    $stmt=$pdo->prepare('SELECT cart.*, shop.name AS shop_name FROM cart INNER JOIN shop ON cart.shop_id = shop.id WHERE cart.user_id = ?');
    $stmt->execute([$_SESSION['user_login']]);
    $carts = $stmt->fetchAll();

    $stmt=$pdo->prepare('SELECT shop.*, shop_type.name AS shop_type_name FROM shop INNER JOIN shop_type ON shop.type_id = shop_type.id');
    $stmt->execute();
    $shops = $stmt->fetchAll();

    $stmt = $pdo->prepare('SELECT orders.*, CONCAT(users.firstname," ",users.lastname) AS username FROM orders LEFT JOIN users ON orders.delivery_id = users.id WHERE orders.user_id = ?');
    $stmt->execute([$_SESSION['user_login']]);
    $dataOrders = $stmt->fetchAll();

    include 'modal.php';
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
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="history">การสั่งอาหาร</a></li>
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
                                            <img src="<?= $food['food_img']; ?>" class="card-img-top food-img" width="50px">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $food['name']; ?></h5>
                                                <p class="card-text"><?= $food['food_type_name'] . ' - ' ?> <a href="shop.php?id=<?= $food['shop_id'] ?>"><?= $food['shop_name'] ?></a></p>
                                                <p class="card-text"><strong>ราคา: <?= number_format($food['price'], 2); ?>บาท</strong></p>
                                                <div class="modal fade" id="addcart-<?= $food['id']; ?>" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content shadow-lg border-0">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title">Confirm Add</h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="functions/add_cart.php" method="post">
                                                                    <h6 class="mb-3 text-muted">จำนวน</h6>
                                                                    <div class="list-group mb-3">
                                                                        <input type="number" name="qty" value="1" >
                                                                        <input type="hidden" name="id" value="<?= $food['id'] ?>">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcart-<?= $food['id']; ?>">เลือกลงตะกล้า</button>
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
                                <h3>Order</h3>
                            </div>
                            <div class="card-body">
                                <table id="admin-table" class="table table-bordered table-striped">
                                    <thead class="thead-dark">  
                                        <tr>
                                            <th>#</th>
                                            <th>time</th>
                                            <th>price</th>
                                            <th>ผู้ส่งอาหาร</th>
                                            <th>time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataOrders as $data): ?>
                                        <tr>
                                            <td>
                                                <?php echo $data['id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['delivery_status']; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['pay_status']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (!empty($data['delivery_id'])) {
                                                    echo $data['username']; 
                                                } else {
                                                    echo 'ยังไม่มีผู้ส่ง !!!'; 
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $data['time']; ?>
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
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h3 class="mb-0">Shopping Cart</h3>
                                <div class="d-flex align-items-center">
                                    <?php if (!empty($carts)): ?>
                                        <?php
                                            $totalPrice = 0;
                                            foreach ($carts as $cart) {
                                                $totalPrice += $cart['total_price'] * $cart['qty'];
                                            }
                                        ?>
                                        <p class="mb-0 me-3">รวมทั้งหมด: <strong><?= number_format($totalPrice, 2) ?> บาท</strong></p>
                                    <?php else: ?>
                                        <p class="mb-0 me-3">ตะกร้าว่าง</p>
                                    <?php endif; ?>
                                    <button class="btn btn-light btn-sm text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#pay">
                                        Pay Now
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <table id="admin-table" class="table table-hover table-bordered text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Img</th>
                                            <th>Name</th>
                                            <th>Shop Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($carts)): ?>
                                            <?php foreach ($carts as $cart): ?>
                                            <tr>
                                                <td class="align-middle"><?= $cart['id'] ?></td>
                                                <td class="align-middle">
                                                    <img src="<?= $cart['food_img'] ?>" alt="Image" class="img-thumbnail" style="max-width: 80px; height: auto;">
                                                </td>
                                                <td class="align-middle"><?= $cart['name'] ?></td>
                                                <td class="align-middle"><?= $cart['shop_name'] ?></td>
                                                <td class="align-middle"><?= $cart['qty'] ?></td>
                                                <td class="align-middle text-success">฿<?= $cart['price'] ?></td>
                                                <td class="align-middle text-danger"><?= $cart['discount'] ?>%</td>
                                                <td class="align-middle">
                                                    <form action="functions/delete_cart.php" method="get" onsubmit="return confirm('ลบเลยนะ')">
                                                        <input type="hidden" name="id" value="<?= $cart['id'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">ไม่มีสินค้าในตะกร้า</td>
                                            </tr>
                                        <?php endif; ?>
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
            send('confirm_pay');
        })
    </script>

</body>

</html>