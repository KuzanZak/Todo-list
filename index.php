<?php
spl_autoload_register();

require_once "includes/_functions.php";

use App\Controllers\TaskController;
use App\Controllers\ThemeController;


$controllerTask = new TaskController();
$controllerTheme = new ThemeController();

if (isset($_GET['action']) && $_GET['action'] === 'create') {
    $controllerTask->create();
    exit;
}
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $controllerTask->store();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'taskDone') {
    $controllerTask->notIndex();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'done') {
    $controllerTask->storeDone();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $controllerTask->storeDelete();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'redone') {
    $controllerTask->storeRedone();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'down') {
    $controllerTask->storeDown();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'up') {
    $controllerTask->storeUp();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'createmodify') {
    $controllerTask->createModify();
    exit;
}
if (isset($_POST['action']) && $_POST['action'] === 'modify') {
    $controllerTask->updateModify();
    exit;
}
if (isset($_GET['error']) && $_GET['error'] === 'csrfReferer') {
    $controllerTask->errorReferor();
    exit;
}
if (isset($_GET['error']) && $_GET['error'] === 'csrfToken') {
    $controllerTask->errorToken();
    exit;
}
$controllerTask->index();
