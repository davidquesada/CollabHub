<?php
require_once "database.php";
if (!isset($_SESSION))
    session_start();

function user_logout()
{
    session_destroy();
    session_write_close();
    unset($_SESSION);
}

function user_isLoggedIn()
{
    return isset($_SESSION['user']);
}

function rohit($text)
{
    static $file = NULL;
    if ($file === NULL)
        $file = fopen("/Users/david/collablog.txt", "a");
    
    $line = date("r") . ": " . $text . PHP_EOL;
    fwrite($file, $line);
}

?>