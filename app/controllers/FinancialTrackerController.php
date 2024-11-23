<?php

namespace app\controllers;

use core\Database;
use core\Helpers;

class FinancialTrackerController
{
  private Database $db;
  private Helpers $helper;

  public function __construct()
  {
    $this->db = new Database();
    $this->helper = new Helpers();
  }

  public function addItem(): void
  {
    $assets = $_POST['assets'] ?? [];
    $assets = array_filter((array) $assets);
    if (!empty($assets) && !empty($_POST['type'])) {
      foreach ($assets as $asset) {
        $this->db->query('INSERT INTO financial_items (title, type) VALUES (:title, :type)', [
          'title' => $asset,
          'type' => $_POST['type']
        ]);
      }
    }
    $this->helper->redirect($this->helper->baseUrl());
  }
}