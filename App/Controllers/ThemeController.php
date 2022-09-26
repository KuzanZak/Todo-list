<?php

namespace App\Controllers;

use App\Models\Theme;

class ThemeController
{
    public function add()
    {
        if (isset($_GET["newtheme"]) && !empty($_GET["newtheme"])) {
            $newTheme = strip_tags($_GET["newtheme"]);
        };
        $theme = new Theme;
        $isQueryOk = $theme->addTheme([
            "newtheme" => $newTheme
        ]);

        $result = [
            "ok" => $isQueryOk,
            "idtheme" => $isQueryOk ? Theme::getLastId() : ''
        ];
        echo json_encode($result);
    }
}
