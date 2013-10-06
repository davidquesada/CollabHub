<?php
require_once("../user.php");

if (!user_isLoggedIn())
    return;
$url = @$_GET['url'];

if ($url === NULL)
    return;

$dest = userDirectory() . "/profileImage";

echo $url . "<br>";
echo $dest . "<br>";

// TODO: Maybe try to verify that the url points to a valid image?
//readfile($url);
$r = copy($url, $dest);
var_dump($r);

header("Location: ../../profile.php");

?>