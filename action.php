<?php
try {
    $dbCo = new PDO(
        'mysql:host=localhost;dbname=todolist;charset=utf8',
        'todolist',
        'axaLpG9jTP[(pTZE'
    );
    $dbCo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );
} catch (Exception $e) {
    die("Unable to connect to the database.
        " . $e->getMessage());
};

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

if (isset($_GET["action"]) && isset($_GET["id_task"]) && $_GET["action"] === "up") {
    $queryP = $dbCo->prepare("SELECT priority FROM task WHERE id_user  = :iduser AND id_task = :idtask");
    $queryP->execute([
        "idtask" => $_GET["id_task"],
        "iduser" => 1
    ]);
    $priority = $queryP->fetch();
    $priority = intval($priority["priority"]);
    var_dump($priority);

    $query = $dbCo->prepare("UPDATE task SET priority = priority - 1 WHERE id_task = :idtask AND done = 0 AND priority <> 1");
    $query->execute([
        "idtask" => $_GET["id_task"]
    ]);

    $query2 = $dbCo->prepare("UPDATE task SET priority = priority + 1  WHERE priority  = $priority -1  AND id_user = 1 AND done = 0 AND id_task <> :idtask");
    $query2->execute([
        "idtask" => $_GET["id_task"]
    ]);

    header("location:index.php");
    exit;
};

if (isset($_GET["action"]) && isset($_GET["id_task"]) && $_GET["action"] === "down") {
    $queryP = $dbCo->prepare("SELECT priority FROM task WHERE id_user  = :iduser AND id_task = :idtask");
    $queryP->execute([
        "idtask" => $_GET["id_task"],
        "iduser" => 1
    ]);
    $priority = $queryP->fetch();
    $priority = intval($priority["priority"]);
    var_dump($priority);

    $query =  $dbCo->query("SELECT Max(priority) AS priority FROM task WHERE id_user = 1 AND done = 0");
    $Maxpriority = $query->fetch();
    $Maxpriority = $Maxpriority["priority"];

    $query = $dbCo->prepare("UPDATE task SET priority = priority + 1 WHERE id_task = :idtask AND done = 0 AND priority <> $Maxpriority");
    $query->execute([
        "idtask" => $_GET["id_task"]
    ]);

    $query2 = $dbCo->prepare("UPDATE task SET priority = priority - 1  WHERE priority  = $priority + 1  AND id_user = 1 AND done = 0 AND id_task <> :idtask");
    $query2->execute([
        "idtask" => $_GET["id_task"]
    ]);
    header("location:index.php");
    exit;
};

if (isset($_GET["action"]) && isset($_GET["id_task"]) && $_GET["action"] === "delete") {
    $query =  $dbCo->prepare("DELETE FROM task WHERE id_task = :idtask");
    $query->execute([
        "idtask" => $_GET["id_task"]
    ]);
    header("location:index.php");
    exit;
};

if (isset($_GET["action"]) && $_GET["action"] === "redone" && isset($_GET["id_task"])) {
    $query =  $dbCo->prepare("SELECT id_task FROM task WHERE id_task = :idtask");
    $query->execute([
        "idtask" => $_GET["id_task"]
    ]);
    $queryD = $dbCo->prepare("UPDATE task SET done = 0 WHERE id_task = :idtask;");
    $queryD->execute([
        "idtask" => $_GET["id_task"]
    ]);

    $query =  $dbCo->query("SELECT Max(priority) + 1 AS priority FROM task WHERE id_user = 1");
    $priority = $query->fetch();
    $priority = $priority["priority"];

    $queryPI = $dbCo->prepare("UPDATE task SET priority = $priority WHERE id_task = :idtask;");
    $queryPI->execute([
        "idtask" => $_GET["id_task"]
    ]);
    header("location:index.php");
    exit;
};
