<?php 
    include 'assets.php';
?>

<div class="contents" id="profile">
    <?php

        require 'db.php';
        session_start();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_login']]);
        $data = $stmt->fetch();

    ?>

    <img src="<?= $data['profile_image'] ?>">

    <?= $data['fname']. " " . $data['lname'] ?>


</div>

<?php include 'status.php'; ?>
<form action="function/user_controller.php?type=update" method="post" enctype="multipart/form-data">
    <input type="email" name="email" value="<?= $data['email'] ?>">
    <input type="text" name="fname" value="<?= $data['fname'] ?>">
    <input type="text" name="lname" value="<?= $data['lname'] ?>">
    <input type="file" name="profile_img">
    <button type="submit" class="btn btn-primary">
        Update
    </button>
</form>