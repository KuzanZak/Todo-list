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
    $controllerTask->historicTaskDone();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'done') {
    $controllerTask->putTaskDone();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $controllerTask->deleteTask();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'redone') {
    $controllerTask->putTaskNotDone();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'down') {
    $controllerTask->downPriorityFromTask();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'up') {
    $controllerTask->upPriorityFromTask();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'createmodify') {
    $controllerTask->modifyTask();
    exit;
}
if (isset($_POST['action']) && $_POST['action'] === 'modify') {
    $controllerTask->saveModify();
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
