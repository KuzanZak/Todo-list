<?php

namespace App\Controllers;

use App\Models\Task;
use App\Views\TaskList;
use App\Views\TaskListItems;

class TaskController
{
    // public function index()
    // {
    //     $task = new Task;
    //     $task->getAllNotDone();
    //     $view = new TaskList([
    //         'taskList' => implode('', array_map(fn ($t) => "<li class=\"list-items\"><a href=\"action.php?action=done&id_task=" . $t["id_task"] . "\" class=\"list-checkbox\"><i class=\"fa fa-check-square icon\" aria-hidden=\"true\"></i></a>" . $t["description_task"] . "<span class=\"date-span\">" . getDateFromArray($t["date_reminder"]) . "</span>
    //         <div class = \"list-links\">" . $t["date_reminder"] . " <a href=\"taskListModify.php?action=modify&id_task=" . $t["id_task"] . "\" class=\"link-modify\"><i class=\"fa fa-commenting-o link-comments\" aria-hidden=\"true\"></i></a>
    //         <a href=\"action.php?action=delete&id_task=" . $t["id_task"] . "\" class=\"link-delete\"><i class=\"fa fa-trash link-comments delete-icon\" aria-hidden=\"true\"></i></a>
    //         <div class=\"priority-modification\"><a href=\"action.php?action=up&id_task=" . $t["id_task"] . "\" class=\"link-up\"><i class=\"fa fa-caret-up link-comments up-caret\" aria-hidden=\"true\"></i></a>
    //         <a href=\"action.php?action=down&id_task=" . $t["id_task"] . "\" class=\"link-down\"><i class=\"fa fa-caret-down link-comments down-caret\" aria-hidden=\"true\"></i></a></div></div>
    //         <div>Thèmes : " . getTheme($t["id_task"]) . "</div></li></li>", $task->getAllNotDone()))

    //     ]);
    //     $view->display();
    // }
    public function index()
    {
        $task = new Task;
        $task->getAllNotDone();
        $html = "";
        foreach ($task->getAllNotDone() as $task) {
            $viewItems = new TaskListItems([
                "idTask" => $task["id_task"],
                "descriptionTask" => $task["description_task"],
                "dateFromArray" =>  getDateFromArray($task["date_reminder"]),
                "dateReminder" => $task["date_reminder"],
                "themes" => getTheme($task["id_task"])
            ]);
            $html .= $viewItems->getHTML();
        }
        // $viewItems->display();
        $view = new TaskList([
            'taskList' => $html
        ]);
        $view->display();
    }
    public function notIndex()
    {
        $task = new Task;
        return $task->getAllDone();
    }
}
