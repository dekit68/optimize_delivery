<?php

$routes = [];
session_start();

route('/', function(){
    include 'assets.php';
    include 'views/home.php';
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
        if ($path !== $uri) continue;
        $callback();
    }
}

?>