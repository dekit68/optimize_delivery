<?php
    require 'config.php';
    include 'includes/modal.php';
    $users = fd('users', $pdo);
    $shop_types = fd('shop_type', $pdo);
    $shops = fd('shop', $pdo);

    $filteredUsers = array_filter($users, function ($user) {
        return in_array($user['role'], ['manager', 'delivery']);
    });
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
</head>
<body>
    <?php include 'components/navbar.php' ?>
    <div class="container my-4">
        <h1>Hello Admin</h1>
        <hr>
        <p>Table Users</p>
        <table id="admin-table" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['role']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['firstname']; ?></td>
                        <td>
                            <button class="btn btn-warning" onclick="editUser('<?php echo $user['id']; ?>')">Edit</button>
                            <button class="btn btn-danger" onclick="deleteUser('<?php echo $user['id']; ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>    

        <p>Table Manage Access</p>
        <table id="admin-table" class="table table-bordered table-striped">
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
                <?php foreach ($filteredUsers as $user): ?>
                    <tr>
                        <td><?php echo $user['role']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['firstname']; ?></td>
                        <td><?= $user['status'] ?></td>
                        <td>
                            <button class="btn btn-success" onclick="editUser('<?php echo $user['id']; ?>')">Active</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>       

        <p>Table Shop Type</p> <button class="btn btn-primary">Add</button>
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
                        <td><?php echo $shop_type['id']; ?></td>
                        <td><?php echo $shop_type['name']; ?></td>
                        <td>
                            <button class="btn btn-danger" onclick="editUser('<?php echo $shop_type['id']; ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>    

        <p>Table Shop</p> <button class="btn btn-primary">Add</button>
        <table id="admin-table" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Approve</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shops as $shop): ?>
                    <tr>    
                        <td><?php echo $shop['id']; ?></td>
                        <td><?php echo $shop['name']; ?></td>
                        <td><?php echo $shop['address']; ?></td>
                        <td><?php 
                        if ($shop['approve'] === 0 ) {
                            echo "ยังไม่อนุมัติ"; 
                        }else {
                            echo "อนุมัติแล้ว";
                        }
                        
                        ?></td>
                        <td>
                            <button class="btn btn-danger" onclick="editUser('<?php echo $shop['id']; ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>    
    </div>
</body>
</html>
