<?php
    require 'config.php';
    $users = fd('users', $pdo);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery | Dashboard</title>
</head>

<body>
    <?php include 'components/navbar.php' ?>
    <div class="container my-4">
        <h1>Hello Delivery</h1>
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
                        <button class="btn btn-danger"
                            onclick="deleteUser('<?php echo $user['id']; ?>')">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลผู้ใช้</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" class="form-control" id="role" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Name</label>
                            <input type="text" class="form-control" id="firstname" required>
                        </div>
                        <input type="hidden" id="userId">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>