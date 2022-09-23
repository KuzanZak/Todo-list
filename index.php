<?php
spl_autoload_register();

require_once "includes/_functions.php";

use App\Controllers\TaskController;
use App\Models\Task;

// $task = new Task;
// $dataTask = $task->getIdThemFromIdTask(["idtask" => 8]);
// foreach ($dataTask as $theme) {
//     var_dump($theme["id_theme"]);
// }

$controller = new TaskController();

if (isset($_GET['action']) && $_GET['action'] === 'create') {
    $controller->create();
    exit;
}
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $controller->store();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'taskDone') {
    $controller->notIndex();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'done') {
    $controller->storeDone();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $controller->storeDelete();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'redone') {
    $controller->storeRedone();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'down') {
    $controller->storeDown();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'up') {
    $controller->storeUp();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'createmodify') {
    $controller->createModify();
    exit;
}
if (isset($_POST['action']) && $_POST['action'] === 'modify') {
    $controller->updateModify();
    exit;
}
if (isset($_GET['error']) && $_GET['error'] === 'csrfReferer') {
    $controller->errorReferor();
    exit;
}
if (isset($_GET['error']) && $_GET['error'] === 'csrfToken') {
    $controller->errorToken();
    exit;
}
$controller->index();
