<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\Theme;
use App\Views\TaskList;
use App\Views\Page;
use App\Views\TaskListForm;
use App\Views\TaskListItems;
use App\Views\TaskListDone;

class TaskController
{
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
        $view = new TaskList([
            'taskList' => $html
        ]);

        $viewPage = new Page([
            "content" => $view->getHTML()
        ]);
        $viewPage->display();
    }
    public function notIndex()
    {
        $task = new Task;
        $task->getAllDone();
        $html = "";
        foreach ($task->getAllDone() as $task) {
            $viewItems = new TaskListDone([
                "idTask" => $task["id_task"],
                "descriptionTask" => $task["description_task"],
                "dateReminder" => $task["date_reminder"]
            ]);
            $html .= $viewItems->getHTML();
        }
        $view = new TaskList([
            'taskList' => $html
        ]);
        $viewPage = new Page([
            "content" => $view->getHTML()
        ]);
        $viewPage->display();
    }

    public function create()
    {
        $theme = new Theme;
        $html = "";
        foreach ($theme->getAll() as $theme) {
            $html .= "<div class=\"theme-list\"><label class=\"label-themes\"><input type=\"checkbox\" name=\"theme[]\" value=\"" . $theme["id_theme"] . "\">" . $theme["theme"] . "</label></div>";
        }
        $viewForm = new TaskListForm([
            "dateDay" =>  date("Y-m-d"),
            "themesDisponibles" => $html,
            "description" => "",
            "datereminder" => "",
            "color" => "",
            "idtask" => "",
            "action" => "add"
        ]);
        $viewPage = new Page([
            "content" => $viewForm->getHTML()
        ]);
        $viewPage->display();
    }

    public function store()
    {
        $newTask = new Task;
        if (isset($_POST["description"]) && isset($_POST["date"]) && isset($_POST["color"]) && isset($newTask->getAddNewPriority()["priority"])) {
            $description = strip_tags($_POST["description"]);
            $date = strip_tags($_POST["date"]);
            $color = strip_tags($_POST["color"]);
            $priority = strip_tags($newTask->getAddNewPriority()["priority"]);
            $priority = intval($priority);
        } else header('location:index.php?error=1');
        if (mb_strlen($description) < 255 && $date >= date("Y-m-d") && ctype_xdigit($color) && mb_strlen($color) == 6 && is_int($priority)) {
            $data = [
                "description" => $description,
                "date" => $date,
                "color" => $color,
                "priority" => $priority,
                "user" => 1
            ];
            $newTask->addTask($data);
            //faire une condition si ca a fonctionné
            $idtask =  Task::getLastId();
            $addTheme = new Theme;
            if (isset($_POST["theme"])) {
                foreach ($_POST["theme"] as $value) {
                    $addTheme->addTheme($value, $idtask);
                }
            }
            header('location:index.php');
        } else header('location:index.php?error=2');
    }

    public function storeDone()
    {
        if (isset($_GET["action"]) && isset($_GET["id_task"]) && $_GET["action"] === "done") {
            $taskDone = new Task;
            $data = [
                'idtask' => $_GET["id_task"],
                'iduser' => 1,
            ];
            $priorityDone = $taskDone->getPriority($data);
            $taskDone->updatePriorityAndDone($data);
            $dataN = [
                'priority' => $priorityDone
            ];
            $taskDone->updateAllPriority($dataN);
            header('location:index.php');
        } else header('location:index.php?error=getpriority');
    }

    public function storeDelete()
    {
        if (isset($_GET["action"]) && isset($_GET["id_task"]) && $_GET["action"] === "delete") {
            $taskDelete = new Task;
            $data = [
                'idtask' => $_GET["id_task"],
                'iduser' => 1
            ];
            $priorityDelete = $taskDelete->getPriority($data);
            $dataD = [
                'idtask' => $_GET["id_task"]
            ];
            $taskDelete->deleteTask($dataD);
            $dataN = [
                'priority' => $priorityDelete
            ];
            $taskDelete->updateAllPriority($dataN);
            header('location:index.php');
        } else header('location:index.php?error=nodelete');
    }

    public function storeRedone()
    {
        if (isset($_GET["action"]) && $_GET["action"] === "redone" && isset($_GET["id_task"])) {
            $taskRedone = new Task;
            $data = [
                'idtask' => $_GET["id_task"]
            ];
            $taskRedone->updateDone0($data);
            $priorityRedone = $taskRedone->getAddNewPriority();
            $dataP = [
                'priority' => $priorityRedone,
                'idtask' => $_GET["id_task"]
            ];
            $taskRedone->updatePriority($dataP);
            header('location:index.php');
        } else header('location:index.php?error=noredone');
    }

    public function storeUp()
    {
        if (isset($_GET["action"]) && isset($_GET["id_task"]) && $_GET["action"] === "up") {
            $taskUp = new Task;
            $data = [
                'idtask' => $_GET["id_task"],
                'iduser' => 1
            ];
            $dataUp = [
                'idtask' => $_GET["id_task"]
            ];
            $priorityUp = $taskUp->getPriority($data);
            $dataUpSibling = [
                'idtask' => $_GET["id_task"],
                'priority' => $priorityUp
            ];
            $taskUp->updateUpPriority($dataUp);
            $taskUp->updateUpPrioritySibling($dataUpSibling);
            header('location:index.php');
        } else header('location:index.php?error=notUp');
    }

    public function storeDown()
    {
        if (isset($_GET["action"]) && isset($_GET["id_task"]) && $_GET["action"] === "down") {
            $taskDown = new Task;
            $data = [
                'idtask' => $_GET["id_task"],
                'iduser' => 1
            ];
            $priorityDown = $taskDown->getPriority($data);
            $MaxPriority = $taskDown->getMaxPriority(['iduser' => 1]);
            $dataDown = [
                'idtask' => $_GET["id_task"],
                'priority' => $MaxPriority
            ];
            $dataDownSibling = [
                'idtask' => $_GET["id_task"],
                'priority' => $priorityDown
            ];
            $taskDown->updateDownPriority($dataDown);
            $taskDown->updateDownPrioritySibling($dataDownSibling);
            header('location:index.php');
        } else header('location:index.php?error=notDown');
    }


    public function createModify()
    {
        if (isset($_GET["action"]) && $_GET["action"] === "createmodify" && isset($_GET["id_task"])) {
            $theme = new Theme;
            $task = new Task;
            $idtask = strip_tags($_GET["id_task"]);
            $idtask = intval($idtask);
            $dataTask = $task->getAllDatasFromATask(['idtask' => $idtask]);
            $themesTask = $task->getIdThemFromIdTask(['idtask' => $idtask]);
            $html = "";
            $allIdThemeFromIdTask = [];
            foreach ($themesTask as $themeT) {
                $allIdThemeFromIdTask[] = $themeT["id_theme"];
            }
            foreach ($theme->getAll() as $themeDb) {
                if (in_array($themeDb["id_theme"], $allIdThemeFromIdTask)) {
                    $html .= "<div class=\"theme-list\"><label class=\"label-themes\"><input type=\"checkbox\" name=\"theme[]\" value=\"" . $themeDb["id_theme"] . "\" checked>" . $themeDb["theme"] . "</label></div>";
                } else $html .= "<div class=\"theme-list\"><label class=\"label-themes\"><input type=\"checkbox\" name=\"theme[]\" value=\"" . $themeDb["id_theme"] . "\">" . $themeDb["theme"] . "</label></div>";
            }

            $viewForm = new TaskListForm([
                "dateDay" =>  date("Y-m-d"),
                "themesDisponibles" => $html,
                "description" => $dataTask["description_task"],
                "datereminder" => $dataTask["date_reminder"],
                "color" => $dataTask["color"],
                "idtask" => $dataTask["id_task"],
                "action" => "modify"
            ]);
            $viewPage = new Page([
                "content" => $viewForm->getHTML()
            ]);
            $viewPage->display();
        }
    }
    public function updateModify()
    {
        $theme = new Theme;
        $task = new Task;
        if (isset($_POST["description"]) && isset($_POST["date"]) && isset($_POST["color"]) && isset($_POST["id_task"])) {
            $newdescription = strip_tags($_POST["description"]);
            $newdate = strip_tags($_POST["date"]);
            $newcolor = strip_tags($_POST["color"]);
            if (mb_strlen($newdescription) < 255 && $newdate >= date("Y-m-d") && ctype_xdigit($newcolor) && mb_strlen($newcolor) == 6) {
                $task->updateAllDatasFromATask([
                    "description" => $newdescription,
                    "date" => $newdate,
                    "color" => $newcolor,
                    "idtask" => $_POST["id_task"]
                ]);
            }
        };
        $idtask =  $_POST["id_task"];
        if (isset($_POST["theme"])) {
            $theme->deleteThemes($idtask);
            foreach ($_POST["theme"] as $value) {
                $theme->addTheme($value, $idtask);
            }
            header('location:index.php');
        } else header('location:index.php?error=notUpdate');
    }
}
