<?php

require '../db.php';
session_start();
header('location: /profile.php');

if ($_GET['type'] == "update") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $profile = null;

    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] == 0) {
        $newFileName = time() . '_' . $_FILES['profile_img']['name'];
        $profile = '../uploads/profile/' . $newFileName;
        move_uploaded_file($_FILES['profile_img']['tmp_name'], $profile);
    }

    try {
        $stmt = $pdo->prepare('UPDATE users SET fname = ?, lname = ?, email = ?'. ($profile ? ', profile_image = ?': "") . "WHERE id = ?");
        $param = [$fname, $lname, $email];
        if ($profile) $param[] = $profile;
        $param[] = $_SESSION['user_login'];
        $stmt->execute($param);
        $_SESSION['success'] = 'Update Success';
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    
}

var_dump($_FILES);

?>