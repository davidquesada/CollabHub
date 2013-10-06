<?php
require_once "common.php";

function talents_get($userID = NULL)
{
    return database_fetch_all_for_user("talents", $userID);
}

function talent_get($talentID)
{
    return database_fetch_id("talents", $talentID);
}

function talents_post($params)
{
    return database_insert_assoc_for_user("talents", $params);
}

function talents_delete($params)
{
    return database_delete_assoc("talents", $params);
}

function talents_put($params)
{
    
}

?>