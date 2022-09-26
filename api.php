<?php
spl_autoload_register();

require_once "includes/_functions.php";

use App\Controllers\ThemeController;

header("Content-type: application/json; charset=UTF-8");

$controllerTheme = new ThemeController();

if (isset($_GET['newtheme'])) {
    $controllerTheme->add();
    exit;
}
