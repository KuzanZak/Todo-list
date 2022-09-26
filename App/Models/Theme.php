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
    public function addThemeForATask(int $value, int $newIdTask): array
    {
        $queryT = self::$connection->prepare("INSERT INTO contain(`id_task`, `id_theme`) VALUES (:idtask, :value);");
        $queryT->execute(['value' => $value, 'idtask' => $newIdTask]);
        return $queryT->fetchAll();
    }

    public function deleteThemes(int $idtask): void
    {
        $queryT =  self::$connection->prepare("DELETE FROM contain WHERE id_task = :idtask");
        $queryT->execute(["idtask" => $idtask]);
    }

    public function addTheme(array $data)
    {
        $query = self::$connection->prepare("INSERT INTO theme (theme_name) VALUES (:newtheme);");
        return $query->execute($data);
    }
}
