<?php
//require_once "../common.php";
require_once "../user.php";

print_r($_SESSION);
print_r($_POST);

rohit("I signed in.");

if (isset($_POST['email']))// && isset($_POST['password']))
{
    if (attemptLogin(@$_POST['email'], @$_POST['password']))
    {
        header("Location: ../../Profile.php");    
    }
    else
        failedLogin();
}
else
    failedLogin();

function failedLogin()
{
    header("Location: ../../index.php?failedLogin&email=" . urlencode(@$_POST['email']));
}

?>