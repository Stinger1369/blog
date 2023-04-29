<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




require __DIR__ . '/vendor/autoload.php';
require_once 'Config/config.php';
require_once 'Core/Router.php';

$router = new \Core\Router();
$router->run();


