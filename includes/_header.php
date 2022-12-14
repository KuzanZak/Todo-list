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
        <h1 class="ttl-header"><span class="ttl-span">To do list</span></h1>
        <nav class="nav-header">
            <ul class="list-header">
                <li class="list-header-items">
                    <a class="header-link" href="index.php">Tâches à effectuer</a>
                </li>
                <li class="list-header-items">
                    <a class="header-link" href="taskList.php">Ajout tâches</a>
                </li>
                <li class="list-header-items">
                    <a class="header-link" href="taskDone.php">Tâches effectuées</a>
                </li>
            </ul>
        </nav>
    </header>
    <section class="todolist">