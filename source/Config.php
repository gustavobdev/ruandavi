<?php
global $db;

define("ROOT", "http://$_SERVER[HTTP_HOST]/");


$host = 'localhost';
$db = 'produtos';
$user = 'root';
$password = '';


try{
    
    $db = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    die($e->getMessage());
}


function url($path)
{
    if ($path) {
        return ROOT . "{$path}";
    }
    return ROOT;
}
