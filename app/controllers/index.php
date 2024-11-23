<?php

$helper = new core\Helpers();
$controllers_path = $helper->basePath('app/controllers');
require_once $controllers_path . '/HomeController.php';
require_once $controllers_path . '/FinancialTrackerController.php';
