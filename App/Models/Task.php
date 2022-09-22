<?php

namespace App\Models;

class Task extends Model
{
    public function getAllNotDone(): array
    {
        $query = self::$connection->prepare("SELECT id_task, description_task, date_reminder FROM task WHERE done = :done AND id_user  = :iduser ORDER BY priority ASC");
        $query->execute([
            "done" => 0,
            "iduser" => 1
        ]);
        return $query->fetchAll();
    }
    public function getAllDone(): array
    {
        $query = self::$connection->prepare("SELECT id_task, description_task, date_reminder FROM task WHERE done = :done AND id_user  = :iduser ORDER BY priority ASC");
        $query->execute([
            "done" => 1,
            "iduser" => 1
        ]);
        return $query->fetchAll();
    }

    public function getAddNewPriority(): array
    {
        $query = self::$connection->query("SELECT Max(priority) + 1 AS priority FROM task WHERE id_user = 1");
        return $query->fetch();
    }

    public function addTask(array $dataSecure): array
    {
        $query = self::$connection->prepare("INSERT INTO task(description_task, date_reminder, color, priority, id_user) values (:description, :date, :color, :priority, :user)");
        $query->execute($dataSecure);
        return $query->fetchAll();
    }

    public function getPriority(array $data): int
    {
        $queryP = self::$connection->prepare("SELECT priority FROM task WHERE id_user  = :iduser AND id_task = :idtask");
        $queryP->execute($data);
        return $queryP->fetchColumn();
    }

    public function updatePriorityAndDone(array $data): void
    {
        $query = self::$connection->prepare("UPDATE task SET done = 1, priority = 0  WHERE id_user  = :iduser AND id_task = :idtask");
        $query->execute($data);
    }

    public function updateAllPriority(array $data): void
    {
        var_dump($data);
        $query2 = self::$connection->prepare("UPDATE task SET priority = priority - 1  WHERE priority > :priority AND id_user = 1 AND done = 0");
        $query2->execute($data);
    }
}
