<?php

$path = $_GET['q'];
$path_parts = explode('/', $path);

if (empty($path_parts[0])) {
    $path_parts[0] = 'home';
}

if (is_file(RD_ROOT . '/controllers/' . $path_parts[0] . '.php')) {
    include(RD_ROOT . '/controllers/' . $path_parts[0] . '.php');
    $controller = new $path_parts[0];
    $controller->getPage();
} else {
    throw new Exception('Controller not found.');
}