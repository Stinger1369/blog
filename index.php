<?php
session_start();


require __DIR__ . '/vendor/autoload.php';
require_once 'Config/config.php';
require_once 'Core/Router.php';

$router = new \Core\Router();
$router->run();
