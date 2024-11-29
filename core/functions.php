<?php

// Dump for debugging
function dump($data, $die = false): void
{
  echo '<pre>';
  print_r($data);
  echo '</pre>';
  if ($die) {
    die();
  }
}

// Redirect to a specific URL path
function redirect($url): void
{
  header('Location: ' . $url);
  exit;
}