<?php

$routes = [];
session_start();

route('/', function(){
    include 'assets.php';
    if (!isset($_SESSION['user_login'])) {
        include 'views/auth.php';
    } else {
        if ($_SESSION['role'] === "admin") {
            include 'views/services/admin.php';
        } elseif ($_SESSION['role'] === "manager") {
            include 'views/services/manager.php';
        } elseif ($_SESSION['role'] === "delivery") {
            include 'views/services/delivery.php';
        } else {
            include 'views/services/user.php';
        }
    }

});

function route(string $path, callable $callback) {
    global $routes;
    $routes[$path] = $callback;
}

run();

function run() {
    global $routes;
    $uri = $_SERVER['REQUEST_URI'];
    foreach ($routes as $path => $callback) {
        if ($path != $uri) continue;
        $callback();
    }
}

?>