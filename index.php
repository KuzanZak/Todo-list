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

$query = $dbCo->prepare("SELECT description_task, date_reminder FROM task WHERE done = 0");
$query->execute();
$result = $query->fetchAll();
echo getHTMLFromToDoList($result, "list", "list-items");
?>
</section>
<script type="text/javascript" src="js/script.js"></script>
</body>

</html>