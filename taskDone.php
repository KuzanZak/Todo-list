<?php
// 0 = tâche non faite
// 1 = tâche faite
spl_autoload_register();


require_once "includes/_functions.php";
include "includes/_header.php";

use App\Models\Task;
use App\Controllers\TaskController;

$controller = new TaskController();

// var_dump($controller->index());
echo getHTMLFromToDoList($controller->notIndex(), "list", "list-items", "list-checkbox", true);
?>
<?php
include "includes/_footer.php";
?>