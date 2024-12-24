<?php
session_start();
$routes = [];

route('/', function(){
    include 'assets.php';
    if (!isset($_SESSION['user_login'])) {
        include 'views/home.php';
    } else {
        if ($_SESSION["role"] === "admin") {
            include 'views/services/admin.php'; 
        } elseif ($_SESSION["role"] === "delivery") {
            include 'views/services/delivery.php';
        } elseif ($_SESSION["role"] === "manager") {
            include 'views/services/manager.php';
        } else {
            include 'views/services/users.php';
        }
    }
});

function route(string $path, callable $callback){
    global $routes;
    $routes[$path] = $callback;
}

run();

function run(){
    global $routes;
    $uri = $_SERVER['REQUEST_URI'];
    foreach ($routes as $path => $callback) {
        if ($path !== $uri) continue;
        $callback();
    }
}

?>