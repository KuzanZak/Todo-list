<?php
include "includes/_header.php";
?>
<form action="" method="post" class="taskList-form">
    <div class="taskList-form">
        <label for="description" class="label-form">Description : </label>
        <input class="input-form" type="textarea" name="description" id="description" min="5" maxlength="255">
    </div>
    <div class="taskList-form">
        <label for="date" class="label-form">Date limite : </label>
        <input class="input-form" type="date" name="date" id="date" min="<?= date("Y-m-d") ?>">
    </div>
    <div class="taskList-form">
        <label for="color" class="label-form">Couleur : </label>
        <input class="input-form" type="text" name="color" id="color" placeholder="Hexadecimal" maxlength="6">
    </div>
    <div class="taskList-form">
        <input type="submit" Value="Ajoutez" class="submit-form">
    </div>
</form>

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

$query =  $dbCo->query("SELECT Max(priority) + 1 AS priority FROM task WHERE id_user = 1");
$priority = $query->fetchall();
$priority = $priority[0]["priority"];


if (isset($_POST["description"]) && isset($_POST["date"]) && isset($_POST["color"]) && isset($priority)) {
    $description = strip_tags($_POST["description"]);
    $date = strip_tags($_POST["date"]);
    $color = strip_tags($_POST["color"]);
    $priority = strip_tags($priority);
    $priority = intval($priority);
    if (!ctype_xdigit($color)) echo "<script>alert(\"Le code hexadécimal n'est pas correct!\")</script>";
    if (mb_strlen($description) < 255 && $date > date("Y-m-d") && ctype_xdigit($color) && mb_strlen($color) == 6 && is_int($priority)) {
        $query = $dbCo->prepare("INSERT INTO task(`description_task`, `date_reminder`, `color`, `priority`, `id_user`) values (:description, :date, :color, :priority, :user)");
        $query->execute([
            "description" => $description,
            "date" => $date,
            "color" => $color,
            "priority" => $priority,
            "user" => 1
        ]);
        // var_dump($query);
        $nb = $query->rowCount();
        // var_dump(($nb));
        if ($nb >= 1) echo "<script>alert(\"La tâche a été ajoutée avec succès :)\")</script>";
        else echo "<script>alert(\"Malheureusement, la tâche n'a pas été ajoutée :/\")</script>";
    }
}


include "includes/_footer.php";
?>