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
    $items = $_POST['assets'] ?? [];
    $item_type = $_POST['type'];
    $existing_items = $this->getAllItems($item_type);

    if (!empty($items)) {
      // Reset list of items
      if (!empty($existing_items)) {
        $this->db->query('DELETE FROM financial_items WHERE type = :type', ['type' => $item_type]);
      }

      foreach ($items as $item) {
        $title = $item['title'];
        $amount = (!empty($item['amount']) && is_numeric($item['amount'])) ? (int)$item['amount'] : 0;

        if (!empty($title) && !empty($amount)) {
          $this->db->query('INSERT INTO financial_items (title, amount, type) VALUES (:title, :amount, :type)', [
            'title' => $title,
            'amount' => $amount,
            'type' => $item_type
          ]);
        }
      }
    }

    $this->helper->redirect($this->helper->baseUrl());
  }

  public function getAllItems($type = null): array
  {
    if (!empty($type)) {
      return $this->db->query('SELECT * FROM financial_items WHERE type = :type', ['type' => $type])->findAll();
    }

    return $this->db->query('SELECT * FROM financial_items')->findAll();
  }

  public function getAllAssets(): array
  {
    return $this->getAllItems('asset');
  }

  public function getAllLiabilities(): array
  {
    return $this->getAllItems('liability');
  }
}