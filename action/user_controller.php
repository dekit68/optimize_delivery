<?php

require '../db.php';
session_start();

if ($_GET['type'] == "update") {
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] = 0) {
        $newName = time() . '_' . $_FILES['profile_img']['name'];
        $profile = '../uploads/profile/' . $newName;
        move_uploaded_file($_FILES['profile_img']['tmp_name'], $profile);
    }

    try {
      
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
}

?>