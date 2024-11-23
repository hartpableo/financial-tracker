<?php

namespace core;

class Router
{
  private array $routes = [
    '/' => [
      'controller' => 'HomeController',
      'method' => 'index',
      'request' => 'GET'
    ],
    '/add-item' => [
      'controller' => 'FinancialTrackerController',
      'method' => 'addItem',
      'request' => 'POST'
    ]
  ];

  public function resolveRoute(string $path, string $request): void
  {
    $route = $this->routes[$path] ?? null;

    if ($route === null) {
      echo '404 - Not Found';
      return;
    }
    elseif ($route['request'] !== $request) {
      echo '405 - Request Not Allowed';
      return;
    }

    $controllerName = 'app\\controllers\\' . $route['controller'];
    $controller = new $controllerName();
    $method = $route['method'];
    $controller->$method();
  }

  public function route(string $path)
  {
    if (array_key_exists($path, $this->routes)) {
      return $path;
    }
    throw new \Exception('Route not found');
  }
}