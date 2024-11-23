<?php

require_once __DIR__ . '/../core/config.php';

session_start();

$path = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$router = new core\Router();
$router->resolveRoute($path, $requestMethod);