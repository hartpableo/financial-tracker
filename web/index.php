<?php

require_once __DIR__ . '/../core/config.php';

session_start();

var_dump((new \core\Helpers())->baseUrl());

$path = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$router = new core\Router();
$router->resolveRoute($path, $requestMethod);