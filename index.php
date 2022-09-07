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
require_once "includes/_functions.php"
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css?<?= time() ?>">
    <title>Todo list : KuzanZak</title>
</head>

<body class="dark-template">
    <header class="header">
        <h1 class="ttl-header">To do list</h1>
        <nav class="nav-header">
            <ul class="list-header">
                <li class="list-header-items">
                    <a class="header-link" href="index.php">Tâche à faire</a>
                </li>
                <li class="list-header-items">
                    <a class="header-link" href="taskList.php">Ajout de tâche</a>
                </li>
            </ul>
        </nav>
    </header>



    <section class="todolist">
        <!-- <form action="index.php" method="get" class="form">
                <div>
                    <input type="text" placeholder="Ajouter une tâche"><input type="submit" value="OK">
                </div>
            </form> -->
        <!-- <ul class="list"> -->
        <?php
        $query = $dbCo->prepare("SELECT description_task, date_reminder FROM task WHERE done = 0");
        $query->execute();
        $result = $query->fetchAll();
        echo getHTMLFromToDoList($result, "list", "list-items");
        ?>
    </section>


    <script type="text/javascript" src="js/script.js"></script>
</body>

</html>