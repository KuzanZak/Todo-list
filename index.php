<?php
spl_autoload_register();


require_once "includes/_functions.php";

use App\Models\Task;
use App\Controllers\TaskController;

$controller = new TaskController();

$controller->index();
?>
<?php
include "includes/_footer.php";
?>