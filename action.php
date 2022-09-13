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
