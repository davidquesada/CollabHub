<?php
require_once "common.php";

function tags_get($userID = NULL)
{
    if ($userID === NULL)
        $userID = $_SESSION['user']['id'];
    return database_fetch_all_for_user("user_tags", $userID);
}

function tags_post($params)
{
    return database_insert_assoc_for_user("user_tags", $params);
}

function tags_delete($params)
{
    
}

?>