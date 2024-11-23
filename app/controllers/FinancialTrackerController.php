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
    $existing_items = $this->getItems();

    /**
     * Note:
     *  Simplify/refactor this logic to make it more readable and maintainable.
     *  Fix the handling of items when multiples actions are performed before submitting the form.
     */
    if (!empty($assets) && !empty($item_type)) {
      foreach ($assets as $asset) {
        if ($this->itemAlreadyExists($asset['title'])) {
          // check if the amount has changed and update if so
          $item = $this->db->query('SELECT * FROM financial_items WHERE title = :title', ['title' => $asset['title']])->find();
          if ($item['amount'] !== $asset['amount'] && $item['type'] === $item_type) {
            $this->db->query('UPDATE financial_items SET amount = :amount WHERE title = :title', [
              'title' => $asset['title'],
              'amount' => (int)$asset['amount'],
            ]);
          }
          continue;
        }
        $this->db->query('INSERT INTO financial_items (title, type, amount) VALUES (:title, :type, :amount)', [
          'title' => $asset['title'],
          'type' => $item_type,
          'amount' => (int)$asset['amount'],
        ]);
      }
    }

    // Remove items that are not in the form anymore
    if (!empty($existing_items)) {
      foreach ($existing_items as $existing_item) {
        $item = array_filter($assets, function ($asset) use ($existing_item) {
          return $asset['title'] === $existing_item['title'];
        });

        if (empty($item)) {
          $this->db->query('DELETE FROM financial_items WHERE id = :id', ['id' => $existing_item['id']]);
        }
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