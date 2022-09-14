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
?>
<?php
include "includes/_footer.php";
?>