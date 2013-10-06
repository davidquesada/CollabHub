<?php
$databaseServer = "158.130.157.168";
$databaseUsername = "root";
$databasePassword = "baka";

if (TRUE) // If running only on localhost.
{
	$databaseServer = "localhost";
	$databasePassword = "";
}

$databaseName = "collab";

$database = NULL;

$database = mysqli_connect($databaseServer, $databaseUsername, $databasePassword, $databaseName);

function database_prep($string)
{
    global $database;
    return mysqli_real_escape_string($database, $string);
}

function database_insert_assoc($table, $vals)
{
    $keys = array_keys($vals);
    $vals = array_values($vals);
    
    foreach ($keys as &$key)
        $key = "`$key`";
    foreach ($vals as &$val)
        $val = "'" . database_prep($val) . "'";
    
    $query = "INSERT INTO `$table` ( ";
    $query .= implode(', ', $keys);
    $query .= ") VALUES ( ";
    $query .= implode(', ', $vals);
    $query .= " );";
    
    global $database;
    return $database->query($query);
}

function database_insert_assoc_for_user($table, $vals)
{
    $vals['user_id'] = $_SESSION['user']['id'];
    return database_insert_assoc($table, $vals);
}

function database_fetch_all($query)
{
    global $database;
    $raw = $database->query($query);
    $result = array();
    
    if (@(strlen($database->error)))
		die("Query: ($query), Error: " . $database->error);
    
    while ($result[] = $raw->fetch_assoc());
    array_pop($result);
    $raw->free();
    return $result;
}

function database_fetch_id($table, $objectID)
{
    $table = database_prep($table);
    $objectID = database_prep($objectID);
    $query = "SELECT * FROM `$table` WHERE `id` = '$objectID' LIMIT 1;";
    $arr = database_fetch_all($query);
    return @($arr[0]);
}

function database_fetch_all_for_user($table, $userId = NULL, $suffix = NULL)
{
    if ($userId === NULL)
        $userId = database_prep($_SESSION['user']['id']);
    $table = database_prep($table);
    if ($suffix === NULL)
        $suffix = "";
    $query = "SELECT * FROM `$table` WHERE `user_id` = '$userId' $suffix";
    return database_fetch_all($query);
}

function database_delete_id($table, $id)
{
    $id = database_prep($id);
    $query = "DELETE FROM `$table` WHERE `id` = '$id' LIMIT 1;";
    global $database;
    return $database->query($query);
}

function database_delete_assoc($table, $params)
{
    if (!isset($params['id']))
        return "Insufficient parameters. You need to set an ID to delete.";
    return database_delete_id($table, $params['id']);
}

function database_update($table, $id, $vals)
{
    global $database;
    
    $query = "UPDATE $table SET ";
    $lines = array();
    foreach ($vals as $key => $val)
    {
        $val = database_prep($val);
        $key = database_prep($key);
        $lines[] = " `$key` = '$val' ";
    }
    $query .= implode(",", $lines);
    
    $query .= " WHERE `id` = '$id' LIMIT 1;";
    echo $query;
    return $database->query($query);

    
}