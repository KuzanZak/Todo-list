<?php

namespace App\Controllers;

use App\Models\Theme;
use App\Views\TaskListForm;

class ThemeController 
{
    // public function index()
    // {
    //     $theme = new Theme;
    //     $html = "";
    //     foreach ($theme->getAll() as $theme) {
    //         $viewThemes = new TaskListForm([
    //             "dateDay" =>  date("Y-m-d"),
    //             "themesDisponibles" => $task["description_task"]
    //         ]);
    //         $html .= $viewItems->getHTML();
    //     }
    //     // // $viewItems->display();
    //     // $view = new taskListForm([
    //     //     'taskList' => $html
    //     // ]);
    //     // $view->display();
    // }