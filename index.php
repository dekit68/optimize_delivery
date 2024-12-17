<?php

$routes = [];
session_start();

route('/', function(){
    Assets();
    if (!isset($_SESSION['user_login']) || empty($_SESSION['user_login'])) {
        include 'views/home.php'; 
    } else {
        include 'views/services/users.php';
    }
});

route('/profile', function(){
    ProtectRoute();
    Assets();
    include 'views/profile.php';
});

route('/update_profile', function(){
    include 'functions/update_profile.php';
});


route('/dashboard', function(){
    ProtectRoute();
    Assets();

    $user = $_SESSION['user_login'];
    $role = $_SESSION['role'];
    
    if ($user) {
        if ($role === 'admin') {
            include 'views/dashboard/admin.php';
        } elseif ($role === 'manager') {
            include 'views/dashboard/manager.php';
        } elseif ($role === 'delivery') {
            include 'views/dashboard/delivery.php';
        } else {
            header("Location: /");
        }
    }
});

route('/auth/login', function(){
    include 'functions/login.php';
});

route('/auth/register', function(){
    include 'functions/register.php';
});

route('/logout', function(){
    session_unset();
    header("location: /");
});

route('/login', function(){
    Assets();
    include 'views/login.php';
});

route('/register', function(){
    Assets();
    include 'views/register.php';
});

route('/404', function(){
    echo 'Not Found';
});

include 'functions/data.php';

function route(string $path, callable $callback){
    global $routes;
    $routes[$path] = $callback;
}

function ProtectRoute() { 
    if (!isset($_SESSION['user_login'])) {
        header("location: /");
        exit();
    }
}

function Assets() {
    include 'assets.php';
}

run();

function run(){
    global $routes;
    $uri = $_SERVER['REQUEST_URI'];
    $found = false;

    foreach ($routes as $path => $callback) {
        if ($path !== $uri) continue;
        $found = true;
        $callback();
    }

    if (!$found) {
        $notf = $routes['/404'];
        $notf();
    }
}

?>