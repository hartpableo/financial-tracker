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
    $existing_items = $this->getAllItems($item_type);

    if (!empty($assets)) {
      // Reset list of items
      foreach ($existing_items as $key => $item) {
        $this->db->query('DELETE FROM financial_items WHERE id = :id', ['id' => $item['id']]);
      }

      foreach ($assets as $key => $asset) {
        $title = $asset['title'];
        $amount = (!empty($asset['amount']) && is_int($asset['amount'])) ? $asset['amount'] : 0;

        if (!empty($title)) {
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