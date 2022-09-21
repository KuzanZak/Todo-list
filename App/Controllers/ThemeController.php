<?php

namespace App\Controllers;

use App\Models\Theme;
use App\Views\TaskListForm;

class ThemeController
{
    public function store()
    {
        $addTheme = new Theme;
        $data = [];
        if (isset($_POST["theme"])) {
            foreach ($_POST["theme"] as $value) {
                $data[] = $_POST["theme"];
                $addTheme->addTheme($data, $newIdTask);
            }
        }
    }
}
