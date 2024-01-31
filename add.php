<?php

session_start();

require_once("database.php");
require_once("config.php");

$task = strip_tags($_POST['task']);
if($task == ''){
    echo 'Введите задание';
    exit();
}

$task_name = strip_tags($_POST['name']);
if($task_name == ''){
    echo 'Введите название';
    exit();
}

$db = new DbConnection($servername,$username,$password,$database);

$task_limit_date = $_POST['task-limit-date'];
if($task_limit_date == ''){
    if($db->createInsertTransaction($_SESSION['user_id'],$task_name,$task) != true){
        echo $var;
    }
}
else{
    if($db->createInsertTransaction($_SESSION['user_id'],$task_name,$task,$task_limit_date) != true){
        echo $var;
    }
}

header('Location: /');
die();