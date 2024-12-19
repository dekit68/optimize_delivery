<?php
    require 'config.php';
    include 'modal.php';
    $users = fd('users', $pdo);
    $shop_types = fd('shop_type', $pdo);
    $shops = fd('shop', $pdo);

    $filu = array_filter($users, function ($user) {
        return in_array($user['role'], ['manager', 'delivery', 'user']);
    });
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
</head>

<style>
</style>

<body>
    <?php include 'navbar.php' ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="user">User</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="shop">Shop</a></li>
                    <li class="nav-item"><a href="" class="nav-link nav-content" data-content="shoptype">Shoptype</a></li>
                </ul>
            </div>
            <div class="col-md-10 my-4">
                <div class="container">
                    <div class="contents" id="user">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3>User</h3>
                                <button class="btn btn-primary">Create</button>
                            </div>
                            <div class="card-body">
                                <table id="admin-table" class="table table-bordered table-striped ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($filu as $user): ?>
                                        <tr>
                                            <td>
                                                <?php echo $user['role']; ?>
                                            </td>
                                            <td>
                                                <?php echo $user['email']; ?>
                                            </td>
                                            <td>
                                                <?php echo $user['firstname']." ".$user['lastname']; ?>
                                            </td>
                                            <td>
                                                <?= $user['status'] == 0 ? 'disable' : 'enable' ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if ($user['status'] == 0) {
                                                ?>
                                                <form action="functions/user_access.php" method="get">
                                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                    <input type="hidden" name="action" value="enable">
                                                    <button class="btn btn-success" type="submit">Enable</button>
                                                </form>
                                                <?php
                                                } else {
                                                ?>
                                                <form action="functions/user_access.php" method="get">
                                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                    <input type="hidden" name="action" value="disable">
                                                    <button class="btn btn-danger" type="submit">Disable</button>
                                                </form>
                                                <?php
                                                }
                                                ?>
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
                                            <th>Manager</th>
                                            <th>Type</th>
                                            <th>Phone</th>
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
                                                <?php echo $shop['user_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $shop['type_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $shop['phone']; ?>
                                            </td>
                                            <td>
                                            <?php
                                                if ($shop['approve'] == 0) {
                                                ?>
                                                <form action="functions/rep_access_shop.php" method="get">
                                                    <input type="hidden" name="id" value="<?= $shop['id'] ?>">
                                                    <input type="hidden" name="action" value="enable">
                                                    <button class="btn btn-success" type="submit">Enable</button>
                                                </form>
                                                <?php
                                                } else {
                                                ?>
                                                <form action="functions/rep_access_shop.php" method="get">
                                                    <input type="hidden" name="id" value="<?= $shop['id'] ?>">
                                                    <input type="hidden" name="action" value="disable">
                                                    <button class="btn btn-danger" type="submit">Disable</button>
                                                </form>
                                                <?php
                                                }
                                                ?>
                                                <button class="btn btn-danger"
                                                    onclick="">Delete</button>
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
        })
    </script>

</body>

</html>