<?php
header("Content-type: application/json; charset=UTF-8");
spl_autoload_register();

require_once "includes/_functions.php";

use App\Controllers\ThemeController;

$controllerTheme = new ThemeController();

if (isset($_GET['newtheme'])) {
    $controllerTheme->add();
    exit;
}
