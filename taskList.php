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
?>
<form action="" method="post" class="main-taskList-form">
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
    <fieldset id="themes">
        <legend>Choisissez vos thèmes</legend>
        <?php
        $queryT =  $dbCo->query("SELECT id_theme, theme_name AS theme FROM theme");
        $themes = $queryT->fetchall();
        foreach ($themes as $theme) {
            echo "<div id=\"theme-list\"><label><input type=\"checkbox\" name=\"theme[]\" value=\"" . $theme["id_theme"] . "\">" . $theme["theme"] . "<label></div>";
        }
        ?>
        <a href="#themes" class="link-add-theme" id="link-add-theme"><i class="fa fa-plus-square-o icon-add-theme" id="icon-add-theme" aria-hidden="true"></i></a>
        <div class="add-theme" id="add-theme" hidden>
            <label><input type="text" name="newtheme" id="newtheme"></label>
            <button type="button" id="add-button" class="add-button">Ajouter le thème</button>
        </div>
    </fieldset>
    <div class="taskList-form">
        <input type="submit" Value="Ajoutez" class="submit-form">
    </div>
</form>

<?php
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
    if (mb_strlen($description) < 255 && $date >= date("Y-m-d") && ctype_xdigit($color) && mb_strlen($color) == 6 && is_int($priority)) {
        $query = $dbCo->prepare("INSERT INTO task(`description_task`, `date_reminder`, `color`, `priority`, `id_user`) values (:description, :date, :color, :priority, :user)");
        $query->execute([
            "description" => $description,
            "date" => $date,
            "color" => $color,
            "priority" => $priority,
            "user" => 1
        ]);
        $nb = $query->rowCount();
        // if ($nb >= 1) echo "<script>alert(\"La tâche a été ajoutée avec succès :)\")</script>";
        // else echo "<script>alert(\"Malheureusement, la tâche n'a pas été ajoutée :/\")</script>";
    }
    $newIdTask = $dbCo->lastInsertId();
}
if (isset($_POST["theme"])) {
    foreach ($_POST["theme"] as $value) {
        $queryT = $dbCo->prepare("INSERT INTO contain(`id_task`, `id_theme`) VALUES ($newIdTask, :value);");
        $queryT->execute([
            "value" => $value
        ]);
    }
}
include "includes/_footer.php";
//group concat

?>