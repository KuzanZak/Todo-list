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
    public function addTheme(array $data, int $newIdTask): array
    {
        $queryT = self::$connection->prepare("INSERT INTO contain(`id_task`, `id_theme`) VALUES ($newIdTask, :value);");
        $queryT->execute([$data]);
        return $queryT->fetchAll();
    }
}

if (isset($_POST["theme"])) {
    foreach ($_POST["theme"] as $value) {
        $queryT = self::$connection->prepare("INSERT INTO contain(`id_task`, `id_theme`) VALUES ($newIdTask, :value);");
        $queryT->execute([$data]);
    }
}
