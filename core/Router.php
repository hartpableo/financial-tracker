<?php

namespace core;

class Router
{
  private array $routes = [
    '/' => [
      'controller' => 'HomeController',
      'method' => 'index',
      'request' => 'GET'
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
}