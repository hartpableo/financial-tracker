<?php

function dump($data, $die = false): void
{
  echo '<pre>';
  print_r($data);
  echo '</pre>';
  if ($die) {
    die();
  }
}