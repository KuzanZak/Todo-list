<?php
include "includes/_header.php";
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

$query =  $dbCo->query("SELECT Max(priority) + 1 AS priority FROM task WHERE id_user = 1");
$priority = $query->fetch();
$priority = $priority["priority"];

$query = $dbCo->prepare("SELECT `id_task`, `description_task`, `date_reminder`, `color`, `priority` FROM task WHERE id_task = :idtask");
$query->execute([
    "idtask" => $_GET["id_task"]
]);
$result = $query->fetch();
?>
<form action="" method="post" class="taskList-form">
    <div class="taskList-form">
        <label for="description" class="label-form">Description : </label>
        <input class="input-form" type="textarea" name="description" id="description" min="5" maxlength="255" value="<?= $result["description_task"] ?>">
    </div>
    <div class="taskList-form">
        <label for="date" class="label-form">Date limite : </label>
        <input class="input-form" type="date" name="date" id="date" min="<?= date("Y-m-d") ?>" value="<?= $result["date_reminder"] ?>">
    </div>
    <div class="taskList-form">
        <label for="color" class="label-form">Couleur : </label>
        <input class="input-form" type="text" name="color" id="color" placeholder="Hexadecimal" maxlength="6" value="<?= $result["color"] ?>">
    </div>
    <div class="taskList-form">
        <input type="submit" Value="Modifiez" class="submit-form">
        <input type="hidden" name="id_task" id="id_task" value="<?= $result["id_task"] ?>">
    </div>
</form>


<?php

if (isset($_POST["description"]) && isset($_POST["date"]) && isset($_POST["color"]) && isset($_POST["id_task"])) {
    $description = strip_tags($_POST["description"]);
    $date = strip_tags($_POST["date"]);
    $color = strip_tags($_POST["color"]);
    $idtask = strip_tags($_POST["id_task"]);
    $idtask = intval($idtask);
    if (!ctype_xdigit($color)) echo "<script>alert(\"Le code hexadécimal n'est pas correct!\")</script>";
    if (mb_strlen($description) < 255 && $date >= date("Y-m-d") && ctype_xdigit($color) && mb_strlen($color) == 6 && is_int($idtask)) {
        $query = $dbCo->prepare("UPDATE task SET `description_task` = :description, `date_reminder` = :date, `color` = :color WHERE id_task = :idtask");
        $query->execute([
            "description" => $description,
            "date" => $date,
            "color" => $color,
            "idtask" => $idtask
        ]);
        $nb = $query->rowCount();
        header("location: index.php");
    }
}
?>

<?php
include "includes/_footer.php";
?>