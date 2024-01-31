<?php

session_start();
require_once("database.php");
require_once("config.php");

$login = htmlspecialchars($_POST['login']);
$pass = htmlspecialchars($_POST['password']);

$db = new DbConnection($servername,$username,$password,$database);

$res = $db->userReg($login,$pass);

if($res == true){
    $res = $db->checkUserByLogin($login);
    if(is_array($res)){
        if($res[0]){
            $result = $res[1]->fetch_array();
            $_SESSION['user_id'] =  $result['user_id'];
            $_SESSION['user_login'] = $result['user_login'];

            header("Location: /");
            die();
        }

    }
    else{
        print_r("<br />Что то не так 1<br />");
        print_r($res);
    }
}
else if($res == false){
    print_r("<br />Такой пользователь уже существует<br />");

}
else{
    print_r("<br />Что то не так 3<br />");
    print_r($res);
}