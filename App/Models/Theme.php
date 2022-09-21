<?php

namespace App\Models;

class Theme extends Model
{
    public function getAll(): array
    {
        $query = self::$connection->prepare("SELECT id_theme, theme_name AS theme FROM theme");
        $query->execute();
        return $query->fetchAll();
    }
}

// foreach ($themes as $theme) {
//     echo "<div id=\"theme-list\"><label class=\"label-themes\"><input type=\"checkbox\" name=\"theme[]\" value=\"" . $theme["id_theme"] . "\">" . $theme["theme"] . "</label></div>";
// }
