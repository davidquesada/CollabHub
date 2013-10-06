<?php
require_once (dirname(__FILE__)."/../user.php");

if (!isset($_REQUEST['isCreatingAccount']))
    return;

$ret = addUser();
// If the add didn't return successfully...
if (!$ret)
{
    $error = "Blahsomethingblah";
    return;
}

header("Location: welcome.php");

?>