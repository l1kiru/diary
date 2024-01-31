<?php 
    
require_once("database.php");
require_once("config.php");
$db = new DbConnection($servername,$username,$password,$database);

if(empty($_SESSION['user_id'])){
    $str = file_get_contents('html/html_reg_or_auth.php');
    echo $str;
}
else{
    $str = <<< html
    <div class="login-info row">
        <span class="col-6 login-info-span">Вы авторизованны как: $_SESSION[user_login]</span>
        <a href="/logout.php" class="col-6">
            <button class="btn btn-red login-info-a"> Выйти </button> 
        </a>
    </div>
    html;
    echo $str;

    $str = file_get_contents('html/html_card_creator.php');
    echo $str;

    $db = new DbConnection($servername,$username,$password,$database);
    $res = $db->createSelectTransaction($_SESSION['user_id']);
    echo '<ul class="row justify-content-center">';
    foreach($res as $row){
        if($row['task_limit_date']){
            $date_text = 'Выполнить до: ' . (string)$row['task_limit_date'];
        }
        else{
            $date_text = 'Не ограничено по времени.';
        }
        $str = <<< html
            <div id='task-card-id-$row[task_id]' class="task-card card col-4">
                <h4 class="card-up"> $row[task_name] </h4>
                <h5 class="card-up"> $date_text </h5>
                <span class="card-middle"> $row[task_text] </span>
                <div class="card-down"> 
                <a href="/delete.php?task_id={$row['task_id']}"> <button type="submit" class="btn btn-red"> Удалить </button> <a>
                </div>
            </div>
            html;
        
        echo $str;
    }
    echo '</ul>';
}