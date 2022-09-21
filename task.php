<?php
spl_autoload_register();

use App\Models\Task;

$task = new Task();
var_dump($task->getAllNotDone());
