<?php 

$host = 'localhost';
$dbname = 'mec_foods';
$user = 'root';
$pass = '123456';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

date_default_timezone_set('Asia/Bangkok');

function ProtectRoute() {
    if (!isset($_SESSION["user_login"])) {
        header('location: /');
    }
}

function gud($userId, $pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $data = $stmt->fetch();
        return $data;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

function fd($table, $pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM " . $table);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

function gwt($tb1, $tb2, $cl1, $cl2, $req, $repon, $pdo) {
    try {
        $sql = "SELECT $tb1.*, $tb2.$req AS $repon FROM $tb1 INNER JOIN $tb2 ON $tb1.$cl1 = $tb2.$cl2";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}




?>
