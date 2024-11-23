<?php

namespace app\controllers;

use core\Helpers;

class HomeController
{
  private Helpers $helpers;

  public function __construct()
  {
    $this->helpers = new Helpers();
  }

  public function index(): void
  {
    $this->helpers->view('home', ['title' => 'Home']);
  }
}