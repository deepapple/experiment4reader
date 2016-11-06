<?php

function rd_autoloader($class) {
    if (strpos($class, 'Controller')) {
        include('controllers/' . $class . '.php');
    }
    if (strpos($class, 'Model')) {
        include('models/' . $class . '.php');
    }
}