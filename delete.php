<?php

require_once("database.php");
require_once("config.php");

$db = new DbConnection($servername,$username,$password,$database);

if($db->createDeleteTransaction($_GET['task_id']) != true){
    echo $var;
}

header('Location: /');
die();