<?php
require_once "common.php";

function attemptLogin($email, $password)
{
 
    // We are going to attmept to log in.
    $email = @database_prep(strtolower($email));
    $password = @database_prep($password);
    //$query = sprintf("SELECT * FROM `users` WHERE `email` = '%s' AND `password` = '%s' LIMIT 1", $email, $password);
    $query = sprintf("SELECT * FROM `users` WHERE `email` = '%s' LIMIT 1", $email);
 
    global $database;
    $result = $database->query($query);
    
    $ret = NULL;
    
    if (($user = $result->fetch_assoc()))
    {
        $_SESSION['user'] = $user;
        $ret = $user;
    }
    
    @$result->free();
    return $ret;
}

function getUserWithId($id)
{
    $id = database_prep($id);
    $arr = @database_fetch_all("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1;");
    return @$arr[0];
}
function CheckUserWithFBIdExists($FBId)
{
    $FBId = database_prep($FBId);
    $arr = @database_fetch_all("SELECT * FROM `users` WHERE `FBID` = '$id' LIMIT 1;");
    return !(@$arr[0] == NULL);

}
// TODO: I might want to return false if there is already 
function addUser()
{
    $email = @$_POST['email'];
    $password = @$_POST['password'];
    
    if (!$email || !$password)
    {
        return (array("error" => "1", "message" => "Email and Password not set."));
    }
    
    $email = strtolower($_POST['email']);
    $pass = $_POST['password'];
    $first = @$_POST['first_name'];
    $last = @$_POST['last_name'];
    
    $a = database_insert_assoc('users', array("email" => $email, "password" => $password, "first_name" => $first, "last_name" => $last));
    
    global $database;
    if (!$a)
        echo $database->error;
        
    if (1)
        sendWelcomeEmail($email);
    
    attemptLogin($email, $password);
    
    $dir = userDirectory($_SESSION['user']['id']);
    @mkdir($dir, 0777, TRUE);
    
    return TRUE;
}


function userDirectory($id = NULL)
{
    if ($id === NULL)
        $id = $_SESSION['user']['id'];
	return "C:/collabhub/users/$id";
    //return "/Users/david/collabhub/users/$id";
}

require (dirname(__FILE__). '/sendgrid-php/SendGrid_loader.php');


function sendWelcomeEmail($email)
{
    $sendgrid = new SendGrid('rrampr', 'CollabHub');
	$mail = new SendGrid\Mail();
	$mail->
	 setFrom('registration@collabhub.com')->
	 setFromName('CollabHub') ->
	 setSubject('Thanks for Registering a CollabHub Account')->
	 setText('Refer to the subject. TODO: Fill this message with more stuff.');
	//IMPORTANT : So this creates a new mail object with the above content.We grab this from the create email view and set stuff here. Pass me the requisite info here


	//IMPORTANT: send me an array of the people in the buffer email list
	//$buffer = array("shudas93@gmail.com");
    $buffer = array($email);
	$mail->setTos($buffer);

	$sendgrid->smtp->send($mail);
}

?>