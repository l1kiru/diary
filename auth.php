<?php

session_start();
require_once("database.php");
require_once("config.php");

$login = htmlspecialchars($_POST['login']);
$pass = htmlspecialchars($_POST['password']);

$db = new DbConnection($servername,$username,$password,$database);

$res = $db->userAuth($login,$pass);

if($res){
    $result = $res->fetch_array();
    $_SESSION['user_id'] =  $result['user_id'];
    $_SESSION['user_login'] = $login;

    header("Location: /");
    die();
}
else{
    echo 'Такого пользователя не существует';
}