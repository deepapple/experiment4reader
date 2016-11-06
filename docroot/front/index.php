<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

//define('RD_ROOT', dirname(__FILE__));

try {
    include('core/library_debug.php');
    rd_db_page_statistics('page');
    rd_db_page_statistics('header');
    include('settings.php');
    include('core/autoloader.php');
    include('core/db.php');
    spl_autoload_register('rd_autoloader');

    rd_db_page_statistics('header');
    include('core/router.php');
    rd_exec_router();

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}