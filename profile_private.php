<?php
require_once "scripts/tags.php";
require_once "scripts/talents.php";
require_once "scripts/user.php";


$id = NULL;
if (user_isLoggedIn())
    $id = $_SESSION['user']['id'];
if (isset($_GET['userid']))
    $id = $_GET['userid'];

if ($id === NULL)
{
    header("Location: index.php");
}
$user = getUserWithId($id);
    
$isMe = FALSE;
if (user_isLoggedIn())
    $isMe = @($user['id'] == $_SESSION['user']['id']);

    
$talents = talents_get($user['id']);

$profileName = $user['first_name'] . ' ' . $user['last_name'];
$currentLocation = "PennApps";

$selectedTalentId = @$_GET['talent'];


$tags = tags_get($user['id']);

?>