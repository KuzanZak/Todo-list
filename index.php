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

require_once "includes/_functions.php";
include "includes/_header.php";

$query = $dbCo->prepare("SELECT id_task, description_task, date_reminder FROM task WHERE done = 0");
$query->execute();
$result = $query->fetchAll();
echo getHTMLFromToDoList($result, "list", "list-items", "list-checkbox", true);
if (isset($_GET["action"]) && isset($_GET["id_task"]) && $_GET["action"] === "done") {
    $query = $dbCo->prepare("UPDATE task SET done = 1 WHERE id_task = :idtask");
    $query->execute([
        "idtask" => $_GET["id_task"]
    ]);
    header("location:index.php");
};
?>
<?php
include "includes/_footer.php";
?>