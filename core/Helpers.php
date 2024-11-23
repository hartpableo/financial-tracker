<?php

namespace core;

class Helpers
{
  private string $basePath = __DIR__ . '/../';
  private string $baseUrl;
  private array $js = [
    'https://code.jquery.com/jquery-3.7.1.slim.min.js',
  ];

  public function __construct()
  {
    $this->baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    $this->basePath = realpath($this->basePath);
  }

  public function basePath(string $pathToFile = ''): string
  {
    return !empty($pathToFile) ? $this->basePath . DIRECTORY_SEPARATOR . $pathToFile : $this->basePath;
  }

  public function baseUrl(string $pathToFile = ''): string
  {
    return !empty($pathToFile) ? $this->baseUrl . DIRECTORY_SEPARATOR . $pathToFile : $this->baseUrl;
  }

  public function view(string $viewHandle, array $args = []): void
  {
    extract($args);
    require_once $this->basePath('app/views/' . $viewHandle . '.php');
  }

  public function templatePart(string $templatePartHandle, array $args = []): void
  {
    extract($args);
    require_once $this->basePath('app/views/template-parts/' . $templatePartHandle . '.php');
  }

  public function addJs(string $jsHandle): void
  {
    $this->js[] = $jsHandle;
  }

  public function redirect(string $location)
  {
    header('Location: ' . $location);
    exit;
  }

  public function renderJs(bool $echo = false): string
  {
    $this->addJs($this->baseUrl('assets/js/main.js'));

    $js = '';
    foreach ($this->js as $jsHandle) {
      $js .= '<script src="' . $jsHandle . '" defer></script>';
    }

    if ($echo) {
      echo $js;
      return '';
    }

    return $js;
  }
}