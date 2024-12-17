<?php
require 'config.php';

$minLength = 8;

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

if (strlen($password) < $minLength) {
    echo json_encode(array("status" => "error", "msg" => "Please enter a valid password"));
} else{
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $userExists = $stmt->fetchColumn();
    if ($userExists) {
        echo json_encode(array("status" => "error", "msg" => "Email already exists."));
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$firstname, $lastname, $email, $hashedPassword, $role]);

            echo json_encode(array("status" => "success", "msg" => "Registration successfully!"));
        } catch (PDOException $e) {
            echo json_encode(array("status" => "error", "msg" => "Something went wrong, please try again!"));
        }
    }
}