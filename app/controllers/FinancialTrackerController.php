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
    $liabilities = $_POST['liabilities'] ?? [];
    $items = array_merge($assets, $liabilities);

    if (!empty($items)) {
      // Reset list of items
      if (!empty($this->getAllItems())) {
        $this->db->query('DELETE FROM financial_items');
      }

      foreach ($items as $item) {
        $title = $item['title'];
        $amount = (!empty($item['amount']) && is_numeric($item['amount'])) ? (int)$item['amount'] : 0;

        if (!empty($title) && !empty($amount)) {
          $type = in_array($item, $assets) ? 'asset' : 'liability';
          $this->db->query('INSERT INTO financial_items (title, amount, type) VALUES (:title, :amount, :type)', [
            'title' => $title,
            'amount' => $amount,
            'type' => $type
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

  private function getTotalAssets(): int
  {
    $assets = $this->getAllAssets();
    $total = 0;
    foreach ($assets as $asset) {
      $total += $asset['amount'];
    }
    return $total;
  }

  private function getTotalLiabilities(): int
  {
    $liabilities = $this->getAllLiabilities();
    $total = 0;
    foreach ($liabilities as $liability) {
      $total += $liability['amount'];
    }
    return $total;
  }

  public function getTotalMonthlyLiabilities(): int
  {
    $liabilities = $this->getAllLiabilities();
    $total = 0;

    if (!empty($liabilities)) {
      foreach ($liabilities as $liability) {
        $total += $liability['amount'];
      }
    }
    return $total;
  }

  public function getTotalRemainingCash(): int
  {
    return $this->getTotalAssets() - $this->getTotalLiabilities();
  }

  public function getAvailableWeeklyBudget(): float
  {
    return $this->getTotalRemainingCash() / 4;
  }
}