<?php
    $host = "localhost";
    $user = "root";
    $pass = "123456";
    $dbname = "foods";

    try {
        $pdo = new
        PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
?>