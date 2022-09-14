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

if (isset($_GET["newtheme"]) && !empty($_GET["newtheme"])) {
    $query = $dbCo->prepare("INSERT INTO theme (theme_name) VALUES (:newtheme);");
    $isQueryOk = $query->execute([
        "newtheme" => strip_tags($_GET["newtheme"])
    ]);
    $result = [];

    if ($isQueryOk) {
        $result["ok"] = 1;
        $result["message"] = "Le thème est ajouté";
        $result["idtheme"] = $dbCo->lastInsertId();
    } else {
        $result["ok"] = 0;
        $result["message"] = "Le thème n'a pas été ajouté";
    }

    header("Content-type: application/json; charset=UTF-8");
    echo json_encode($result);
    exit;
}
