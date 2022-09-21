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
    public function addTheme(int $value, int $newIdTask): array
    {
        $queryT = self::$connection->prepare("INSERT INTO contain(`id_task`, `id_theme`) VALUES ($newIdTask, :value);");
        $queryT->execute(['value' => $value]);
        return $queryT->fetchAll();
    }
}
