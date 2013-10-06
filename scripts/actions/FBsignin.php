<?php
require_once "../common.php";

    rohit("reached");
    $str_json = file_get_contents('php://input');
    $str_json = $_POST['user'];
    rohit($str_json);
    $Profile = json_decode($str_json,true);
    $arr = @database_fetch_all("SELECT * FROM `users` WHERE `FBID` = '{$Profile['FBID']}' LIMIT 1;");
    if(count($arr)!=0)
    {
        rohit("he has");
    	$query = sprintf("SELECT * FROM `users` WHERE `FBID` = '%s' LIMIT 1", $Profile['FBID']);
 		global $database;
    	$result = $database->query($query);
    	$ret = NULL;
    	if(($user = $result->fetch_assoc()))
    	{
        	$_SESSION['user'] = $user;
       		$ret = $user;
    	}
    	@$result->free();
    }
    else
    {
        rohit("he has not");
	    $a = database_insert_assoc('users',array("email" => $Profile['email'], "password" => "NULL", "first_name" => $Profile['firstname'], "last_name" => $Profile['lastname'] , "bio" => $Profile['bio'] , "FBID" =>$Profile['FBID'] ,"location" => $Profile['location']['name']) );  
	    global $database;
	    if (!$a)
	        echo $database->error;	        
	    if (1)
	        sendWelcomeEmail($email);
	    $query = sprintf("SELECT * FROM `users` WHERE `FBID` = '%s' LIMIT 1", $Profile['FBID']);
 		global $database;
    	$result = $database->query($query);
    	$ret = NULL;
    	if(($user = $result->fetch_assoc()))
    	{
        	$_SESSION['user'] = $user;
       		$ret = $user;
    	}
    	@$result->free();
	    $dir = userDirectory($_SESSION['user']['id']);
	    @mkdir($dir, 0777, TRUE);
	}
?>




