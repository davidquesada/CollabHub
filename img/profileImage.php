<?php
require_once "../scripts/common.php";
require_once "../scripts/user.php";

if (!isset($_GET['id']))
    die();
    
$defaultImage = "./default/profileImage.png";

//header("Location: $defaultImage");

$id = $_GET['id'];
$image = $defaultImage;

$filename = userDirectory($id) . "/profileImage";

if (file_exists($filename))
    $image = $filename;

readfile($image);
?>