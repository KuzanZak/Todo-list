<?php
spl_autoload_register();

require_once "includes/_functions.php";

use App\Controllers\TaskController;
use App\Controllers\ThemeController;
use App\Models\Task;
use App\Models\Theme;

$controller = new TaskController();

if (isset($_GET['action']) && $_GET['action'] === 'create') {
    $controller->create();
    exit;
}
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $controller->store();
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'done') {
    $controller->notIndex();
    exit;
}
var_dump($controller->storeDone());
$controller->index();
// $addTheme = new Theme;
// if (isset($_POST["theme"])) {
//     foreach ($_POST["theme"] as $value) {
//         echo $value;
//     }
// }
