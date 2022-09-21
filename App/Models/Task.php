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

    public function getPriority(array $data): array
    {
        $queryP = self::$connection->prepare("SELECT priority FROM task WHERE id_user  = :iduser AND id_task = :idtask");
        $queryP->execute($data);
        return $queryP->fetch();
    }

    public function updatePriority(array $data): array
    {
        $query = self::$connection->prepare("UPDATE task SET done = 1, priority = 0  WHERE id_task = :idtask");
        $query->execute($data);
        return $query->fetch();
    }

    public function updateAllPriority(array $data): array
    {
        $query2 = self::$connection->prepare("UPDATE task SET priority = priority - 1  WHERE priority > " . $this->getPriority($data) . " AND id_user = 1 AND done = 0");
        $query2->execute($data);
        return $query2->fetch();
    }
}


if (isset($_GET["action"]) && isset($_GET["id_task"]) && $_GET["action"] === "done") {
    $queryP = $dbCo->prepare("SELECT priority FROM task WHERE id_user  = :iduser AND id_task = :idtask");
    $queryP->execute([
        "idtask" => $_GET["id_task"],
        "iduser" => 1
    ]);
    $priority = $queryP->fetch();
    $priority = intval($priority["priority"]);

    $query = $dbCo->prepare("UPDATE task SET done = 1, priority = 0  WHERE id_task = :idtask");
    $query->execute([
        "idtask" => $_GET["id_task"]
    ]);


    $query2 = $dbCo->prepare("UPDATE task SET priority = priority - 1  WHERE priority > $priority AND id_user = 1 AND done = 0");
    $query2->execute();

    header("location:index.php");
    exit;
};
