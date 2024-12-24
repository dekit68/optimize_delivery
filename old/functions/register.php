<?php
session_start();
require '../config.php';

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

try {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $userExists = $stmt->fetchColumn();
    if ($userExists) {
        echo json_encode("Email already exists.");
    } else {
        try {
            if ($role !== 'admin') {
                $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$firstname, $lastname, $email, $password, $role]);
                echo json_encode("Registration successfully!");
            } else {
                $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password, role, status) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$firstname, $lastname, $email, $password, $role, 1]);
                echo json_encode("Registration successfully!");
            }
        } catch (PDOException $e) {
            echo json_encode("Something went wrong, please try again!");
        }
    }
} catch (PDOException $e) {
    echo json_encode($e -> getMessage());
}
