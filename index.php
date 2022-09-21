<?php
spl_autoload_register();

require_once "includes/_functions.php";

use App\Controllers\TaskController;
use App\Controllers\ThemeController;
use App\Models\Task;

$controller = new TaskController();
$controllerT = new TaskController();

if (isset($_GET['action']) && $_GET['action'] === 'create') {
    $controller->create();
    exit;
}
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $controller->store();
    $controllerT->store();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'done') {
    $controller->notIndex();
    exit;
}
$controller->index();
