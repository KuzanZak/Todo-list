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
// 0 = tâche non faite
// 1 = tâche faite
require_once "includes/_functions.php";
include "includes/_header.php";

$query = $dbCo->prepare("SELECT id_task, description_task, date_reminder FROM task WHERE done = :done");
$query->execute([
    "done" => 1
]);
$result = $query->fetchAll();
echo getHTMLFromToDoList($result, "list", "list-items");
?>
<?php
include "includes/_footer.php";
?>