<?php
session_start();

$user = $_POST['username'];
$pass = $_POST['password'];

$suser = 'admin';
$spass = 'admin';

if ($user === $suser) {
    echo json_encode(array("status" => "success", "msg" => "สำเร็จ"));
} else {
    echo json_encode(array("status" => "error", "msg" => "Error!"));
}

?>