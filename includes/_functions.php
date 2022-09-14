<?php
$queryTD = $dbCo->prepare("SELECT GROUP_CONCAT(' ', theme_name) as themes FROM contain JOIN theme USING(id_theme) WHERE id_task = :idtask;");
$queryTD->execute([
    "idtask" => 8
]);
$queryTDID = $queryTD->fetch();
// strip_tags($_POST["id_task"])
var_dump($queryTDID["themes"]);

/**
 * Gives the HTML list from the given array. 
 *
 * @param array $array
 * @param string|null $classUl
 * @param string|null $classLi
 * @return string
 */
function getHtmlFromArray(array $array, string $classUl = null, string $classLi = null): string
{
    if ($classUl) $classUl = " class=\"$classUl\"";
    if ($classLi) $classLi = " class=\"$classLi\"";
    $valueToLi = fn ($v) => "<li$classLi>$v</li>";
    return "<ul$classUl>" . implode("", array_map($valueToLi, $array)) . "</ul>";
}

// function getHTMLFromToDoList(array $array, string $classUl = null, string $classLi = null, string $classLink = null, bool $factor = false): string
// {
//     $string = "";
//     if ($classUl) $classUl = " class=\"$classUl\"";
//     if ($classLi) $classLi = " class=\"$classLi\"";
//     if ($classLink) $classLink = " class=\"$classLink\"";
//     foreach ($array as $task) {
//         if ($factor === true) {
//             $string .= "<li$classLi>
//             <a href=\"action.php?action=done&id_task=" . $task["id_task"] . "\" $classLink><i class=\"fa fa-check-square icon\" aria-hidden=\"true\"></i></a>" . $task["description_task"] . "<span class=\"date-span\">" . getDateFromArray($task["date_reminder"]) . "</span>
//             <div class = \"list-links\">" . $task["date_reminder"] . " <a href=\"taskListModify.php?action=modify&id_task=" . $task["id_task"] . "\" class=\"link-modify\"><i class=\"fa fa-commenting-o link-comments\" aria-hidden=\"true\"></i></a>
//             <a href=\"action.php?action=up&id_task=" . $task["id_task"] . "\" class=\"link-up\"><i class=\"fa fa-caret-up link-comments up-caret\" aria-hidden=\"true\"></i></a>
//             <a href=\"action.php?action=down&id_task=" . $task["id_task"] . "\" class=\"link-down\"><i class=\"fa fa-caret-down link-comments down-caret\" aria-hidden=\"true\"></i></a>
//             <a href=\"action.php?action=delete&id_task=" . $task["id_task"] . "\" class=\"link-celete\"><i class=\"fa fa-trash link-comments delete-icon\" aria-hidden=\"true\"></i></a></div></li>";
//         } else {
//             $string .= "<li$classLi><a href=\"action.php?action=redone&id_task=" . $task["id_task"] . "\"><i class=\"fa fa-undo come-back\" aria-hidden=\"true\"></i></a>" . $task["description_task"] . " " . $task["date_reminder"] . "</li>";
//         }
//     }
//     if (!empty($string)) {
//         return "<ul$classUl>" . $string . "</ul>";
//     } else {
//         return "<p class=\"paragraph\">Aucune tâches effectuées</p>";
//     }
// }
function getHTMLFromToDoList(array $array, string $classUl = null, string $classLi = null, string $classLink = null, bool $factor = false): string
{
    $string = "";
    if ($classUl) $classUl = " class=\"$classUl\"";
    if ($classLi) $classLi = " class=\"$classLi\"";
    if ($classLink) $classLink = " class=\"$classLink\"";
    foreach ($array as $task) {
        if ($factor === true) {
            $string .= "<li$classLi>
            <a href=\"action.php?action=done&id_task=" . $task["id_task"] . "\" $classLink><i class=\"fa fa-check-square icon\" aria-hidden=\"true\"></i></a>" . $task["description_task"] . "<span class=\"date-span\">" . getDateFromArray($task["date_reminder"]) . "</span>
            <div class = \"list-links\">" . $task["date_reminder"] . " <a href=\"taskListModify.php?action=modify&id_task=" . $task["id_task"] . "\" class=\"link-modify\"><i class=\"fa fa-commenting-o link-comments\" aria-hidden=\"true\"></i></a>
            <a href=\"action.php?action=delete&id_task=" . $task["id_task"] . "\" class=\"link-celete\"><i class=\"fa fa-trash link-comments delete-icon\" aria-hidden=\"true\"></i></a>
            <div class=\"priority-modification\"><a href=\"action.php?action=up&id_task=" . $task["id_task"] . "\" class=\"link-up\"><i class=\"fa fa-caret-up link-comments up-caret\" aria-hidden=\"true\"></i></a>
            <a href=\"action.php?action=down&id_task=" . $task["id_task"] . "\" class=\"link-down\"><i class=\"fa fa-caret-down link-comments down-caret\" aria-hidden=\"true\"></i></a></div></div></li>";
        } else {

            $string .= "<li$classLi><a href=\"action.php?action=redone&id_task=" . $task["id_task"] . "\"><i class=\"fa fa-undo come-back\" aria-hidden=\"true\"></i></a>" . $task["description_task"] . " " . $task["date_reminder"] . "</li>";
        }
    }
    if (!empty($string)) {
        return "<ul$classUl>" . $string . "</ul>";
    } else {
        return "<p class=\"paragraph\">Aucune tâches effectuées</p>";
    }
}




function getDateFromArray(string $date): string
{
    $text = "";
    if ($date === date("Y-m-d")) $text = "Dernier jour!";
    return $text;
}

/**
 * Returns serie URL from id
 *
 * @param integer $idSerie
 * @return string
 */
function getSerieURL(int $idSerie): string
{
    return "?serie=$idSerie#question4";
}

/**
 * Returns Html to display a title
 *
 * @param integer $level 
 * @param string $content
 * @param string|null $classCss
 * @return string
 */
function getHtmlTitle(int $level, string $content, string $classCss = null): string
{
    $classCss = $classCss ? " class=\"$classCss\"" : "";
    return "<h${level}${classCss}>$content</h$level>";
}

/**
 * Returns Html for a link
 *
 * @param string $href              target page URL
 * @param string $content           the text to display
 * @param string|null $classCss     CSS class to add
 * @return string
 */
function getHtmlLink(string $href, string $content, string $classCss = null): string
{
    if ($classCss) $classCss = " class=\"$classCss\"";
    return "<a href=\"$href\"$classCss>$content</a>";
}

/**
 * Returns a Html code for the given serie
 *
 * @param array $serie
 * @return string
 */
function getHtmlSerie(array $serie, bool $isFull = false): string
{
    $url = getSerieURL($serie["id"]);

    $html = getHtmlLink($url, "<img src=\"" . $serie["image"] . "\" class=\"serie-img\">");
    $html .= getHtmlTitle(2, getHtmlLink($url, $serie["name"], "serie-lnk"), "serie-ttl");
    $html .= getHtmlTitle(3, "Créée par :");
    $html .= getHtmlFromArray($serie["createdBy"], "text-list", "text-list-item");
    $html .= getHtmlTitle(3, "Acteurs :");
    $html .= getHtmlFromArray($serie["actors"], "text-list", "text-list-item");
    if ($isFull) {
        $html .=  getHtmlTitle(3, "Pays: ") . "<p>" . $serie["country"] . "</p>";
        $html .=  getHtmlTitle(3, "Année: ") . "<p>" . $serie["launchYear"] . "</p>";
        $html .=  getHtmlTitle(3, "Plateforme: ") . "<p>" . $serie["availableOn"] . "</p>";
        $html .= getHtmlTitle(3, "Styles :");
        $html .= getHtmlFromArray($serie["styles"], "text-list", "text-list-item");
    }
    return $html;
}

/**
 * Returns the navigation link for a page
 *
 * @param array $page
 * @param integer $currentPage
 * @return string
 */
function getNavLink(array $page, int $currentPage = 1): string
{
    $class = "main-nav-link";
    if ($currentPage === $page["pageNumber"]) $class .= " active";
    return getHtmlLink($page["href"], $page["pageTitle"], $class);
}

/**
 * Returns main navigation HTML 
 *
 * @param array $pages Pages list
 * @param integer $currentPage
 * @return string
 */
function getMainNavigation(array $pages, int $currentPage = 1): string
{
    // $html = "";
    // foreach($pages as $page) {
    //     $class = "main-nav-link";
    //     if ($currentPage === $page["pageNumber"]) $class .= " active";
    //     $html .= "<li>".getHtmlLink($page["href"], $page["pageTitle"], $class)."</li>";
    // }

    return "<nav class=\"main-nav\">" . getHtmlFromArray(array_map(fn ($p) => getNavLink($p, $currentPage), $pages), "main-nav-list") . "</nav>";
}
