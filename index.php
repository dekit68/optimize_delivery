<?php

    $routes = [];

    route('/', function() {
        echo 'Hello Routes';
    });
    route('/404', function() {
        echo 'not found';
    });

    function route(string $path, callable $callback) {
        global $routes;
        $routes[$path] = $callback;
    }

    run();

    function run(){
        global $routes;
        $uri = $_SERVER['REQUEST_URI'];
        $found = false;

        foreach ($routes as $path => $callback){
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