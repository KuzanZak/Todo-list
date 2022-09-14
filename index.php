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

$query = $dbCo->prepare("SELECT id_task, description_task, date_reminder FROM task WHERE done = :done AND id_user  = :iduser ORDER BY priority ASC");
$query->execute([
    "done" => 0,
    "iduser" => 1
]);
$result = $query->fetchAll();

echo getHTMLFromToDoList($result, "list", "list-items", "list-checkbox", true);

$queryTD = $dbCo->prepare("SELECT GROUP_CONCAT(' ', theme_name) as themes FROM contain JOIN theme USING(id_theme) WHERE id_task = :idtask;");
$queryTD->execute([
    "idtask" => 8
]);
$queryTDID = $queryTD->fetch();
// strip_tags($_POST["id_task"])
var_dump($queryTDID["themes"]);
?>
<?php
include "includes/_footer.php";
?>