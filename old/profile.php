<div class="contents" id="profile">
    <?php
        $userId = $_SESSION['user_login'];
        $user = gud($userId, $pdo);
        if ($user) {
        ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-light">
                    <div class="card-body text-center">

                    <img src="<?= $user['profile_image']; ?>" alt="none image" class="img-fluid mb-3" style="width: 120px; height: 120px; object-fit: cover;">

                    <h4 class="mb-3"><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></h4>
                        <p><strong>User ID:</strong> <?php echo $user['id']; ?></p>
                        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                        <p><strong>Role:</strong> <?php echo ucfirst($user['role']); ?></p>

                    <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#change">Change Password</button>
                    <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
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
                    <form action="functions/profile.php" method="POST" id="updateProfileForm">
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
                    <form action="functions/change.php" method="POST" id="changepassword">
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
        send('changepassword');
        send('updateProfileForm')
    })
    </script>
