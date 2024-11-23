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
    $item_type = $_POST['type'];

    if (!empty($assets) && !empty($item_type)) {
      foreach ($assets as $asset) {
        dump($asset);
        if ($this->itemAlreadyExists($asset['title'])) {
          continue;
        }
        $this->db->query('INSERT INTO financial_items (title, type, amount) VALUES (:title, :type, :amount)', [
          'title' => $asset['title'],
          'type' => $item_type,
          'amount' => (int)$asset['amount'],
        ]);
      }
    }

    $this->helper->redirect($this->helper->baseUrl());
  }

  public function getItems(): array
  {
    return $this->db->query('SELECT * FROM financial_items')->findAll();
  }

  private function itemAlreadyExists($title): bool
  {
    $item = $this->db->query('SELECT * FROM financial_items WHERE title = :title', ['title' => $title])->find();
    return !empty($item);
  }
}