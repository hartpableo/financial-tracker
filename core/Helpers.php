<?php

namespace core;

class Helpers
{
  private string $basePath = __DIR__ . '/../';
  private string $baseUrl;

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
}