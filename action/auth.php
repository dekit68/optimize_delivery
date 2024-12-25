<?php

require '../db.php';
session_start();
header('location: /');

if ($_GET['type'] == "register") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $userEx = $stmt->fetch();

        if (!$userEx) {
            $stmt = $pdo->prepare("INSERT INTO users (email, password, role, fname, lname, address, phone) VALUES (?,?,?,?,?,?,?)");
            $stmt -> execute([$email, $password, $role, $fname, $lname, $address, $phone]);
            $_SESSION['success'] = 'ลงทะเบียน ' . $fname . " ". $lname . " สำเร็จ";
        } else {
            $_SESSION['error'] = 'มีผู้ใช้อยู่แล้ว';
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt -> execute([$email]);
        $data = $stmt -> fetch();
        if ($data) {
            $_SESSION['user_login'] = $data['id'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
}

?>