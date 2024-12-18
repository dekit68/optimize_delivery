<?php
session_start();
include 'config.php';
include 'assets.php';
ProtectRoute();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="app.js"></script>
    <script src="assets/jquery-3.7.1.min.js"></script>
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <div class="container mt-5">
        <?php
        $userId = $_SESSION['user_login'];
        $user = gud($userId, $pdo);

        if ($user) {
            ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-light">
                    <div class="card-body text-center">

                        <?php if (!empty($user['profile_image'])): ?>
                        <img src="<?php echo $user['profile_image']; ?>" alt="Profile Image"
                            class="img-fluid rounded-circle mb-3"
                            style="width: 120px; height: 120px; object-fit: cover;">
                        <?php else: ?>
                        <img src="assets/images/150.png" alt="Default Profile Image"
                            class="img-fluid rounded-circle mb-3"
                            style="width: 120px; height: 120px; object-fit: cover;">
                        <?php endif; ?>

                        <h4 class="mb-3"><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></h4>
                        <p><strong>User ID:</strong> <?php echo $user['id']; ?></p>
                        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                        <p><strong>Role:</strong> <?php echo ucfirst($user['role']); ?></p>

                        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal"
                            data-bs-target="#change">Change Password</button>
                        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal"
                            data-bs-target="#editProfileModal">Edit Profile</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>

    <div class="modal fade" id="editProfileModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/profile.php" method="POST" id="updateProfileForm"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                value="<?php echo $user['firstname']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                value="<?php echo $user['lastname']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo $user['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" name="profile_image" id="profile_image"
                                onchange="previewImage(event)">
                            <br>
                            <img id="imagePreview" src="#" alt="Image preview"
                                style="display:none; width: 100%; max-width: 300px;" />
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/change.php" method="POST" id="updateProfileForm"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="op" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" name="np" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        updateProfile();
    })
    </script>

</body>

</html>