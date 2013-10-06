<?php
require_once "database.php";
if (!isset($_SESSION))
    session_start();

function stories_get()
{
    $query = sprintf("SELECT * FROM stories WHERE `user_id` = '%s';", $_SESSION['user']['id']);
    $result = database_fetch_all($query);
    return $result;
}

function stories_post($params)
{
    $params['user_id'] = $_SESSION['user']['id'];
    $result = database_insert_assoc("stories", $params);
    return $result;
}

function stories_delete($params)
{
    if (!isset($params['id']))
        return "Insufficient parameters";
    return database_delete_id("stories", $params['id']);
}

function stories_put($params)
{
    if (!isset($params['id']))
        return "You need to specify `id` to update.";
    $id = $params['id'];
    unset($params['id']);
    
    return database_update("stories", $id, $params);
}

function stories_get_for_talent($talentID)
{
    $talentID = database_prep($talentID);
    $query = "SELECT * FROM `stories` WHERE `talent_id` = '$talentID';";
    return database_fetch_all($query);
}

function contentForStory($story)
{
    if ($story['sourceType'] == "youtube")
        return contentForYoutubeStory($story);
    $title = $story['title'];
    $date = $story['date'];
    $date = strtotime($date);
    
    $subtitle = $story['subtitle'];
 
    return "
    <li>
        <div bg>
            <h2>$title</h2>
            $date
            <h4>$subtitle</h4><br />
        </div>
    </li>";
}

function contentForYoutubeStory($story)
{
    
}

if (isset($_GET['id']))
{
    stories_put($_GET);
}


?>