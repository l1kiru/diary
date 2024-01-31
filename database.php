<?php

date_default_timezone_set("Europe/Moscow");

class DbConnection {
    public function __construct(
            private $servername,private $username,
            private $password, private $database){
    }

    private function createConn(){
        try{
            $conn = new mysqli($this->servername,$this->username,$this->password,$this->database);
            return [null,$conn];
        }
        catch (Exception $e){
            $err = $e->getMessage();
            return [$err,null];
        }
    }

    public function checkUserById(int $user_id){
        $createdConn = $this->createConn();
        if($createdConn[0] == null){
            try{
                $conn = &$createdConn[1];
                $conn->begin_transaction();
                $result = $conn->query("SELECT * FROM users WHERE user_id = '$user_id'");
                $conn->commit();
                $conn->close();
                if($result)
                    return [true, $result];
                else
                    return [false, null];
            }
            catch(Exception $e){
                $conn->rollback();
                $conn->close();
                return $e->getMessage();
            }
        }
        else{
            return $createdConn[0];
        }
    }
    public function checkUserByLogin($user_login){
        $createdConn = $this->createConn();
        if($createdConn[0] == null){
            try{
                $conn = &$createdConn[1];
                $conn->begin_transaction();
                $res = $conn->query("SELECT user_id, user_login FROM users WHERE user_login = '$user_login'");
                $conn->commit();
                $conn->close();
                if($res->num_rows > 0){
                    return [true,$res];
                }
                else{
                    return [$res,null];
                }
            }
            catch(Exception $e){
                $conn->rollback();
                $conn->close();
                return $e->getMessage();
            }
        }
        else{
            return $createdConn[0];
        }
   }
    public function userReg($user_login,$user_pass){
        $createdConn = $this->createConn();
        if($createdConn[0] == null){
            try{
                $conn = &$createdConn[1];
                $conn->begin_transaction();
                $res = $conn->query("SELECT * FROM users WHERE user_login = '$user_login'");
                if($res->num_rows == 0){
                    $conn->query("INSERT INTO users (user_login, user_password) VALUES ('$user_login','$user_pass')");
                    $conn->commit();
                    $conn->close();
                    return true;
                }
                else{
                    $conn->close();
                    return false;
                }
            }
            catch(Exception $e){
                $conn->rollback();
                $conn->close();
                return $e->getMessage();
            }
        }
        else{
            return $createdConn[0];
        }
    }
    public function userAuth($user_login,$user_pass){
        $createdConn = $this->createConn();
        if($createdConn[0] == null){
            try{
               $conn = &$createdConn[1];
               $conn->begin_transaction();
               $result = $conn->query("SELECT user_id FROM users WHERE user_login = '$user_login' AND user_password = '$user_pass'");
               $conn->commit();
               $conn->close();
               if($result)
                   return $result;
               else
                   return null;
            }
            catch(Exception $e){
                $conn->rollback();
                $conn->close();
                return $e->getMessage();
            }
        }
        else{
            return $createdConn[0];
        }
    }
    public function createInsertTransaction(int $user_id,$task_name,$task_text,$task_limit_date=null){
        $createdConn = $this->createConn();
        if($createdConn[0] == null){
            try{
                $conn = &$createdConn[1];
                $conn->begin_transaction();
                $task_birth_date = date("Y-m-d");
                if($task_limit_date) {
                    $conn->query("INSERT INTO task (user_id, task_name, task_text, task_limit_date, task_birth_date) 
                            VALUES ('$user_id','$task_name','$task_text','$task_limit_date','$task_birth_date')");
                }
                else{
                    $conn->query("INSERT INTO task (user_id, task_name, task_text, task_birth_date) 
                            VALUES ('$user_id','$task_name','$task_text','$task_birth_date')");
                }
                $conn->commit();
                $conn->close();
                return true;
            }
            catch(Exception $e){
                $conn->rollback();
                $conn->close();
                return $e->getMessage();
            }
        }
        else{
            return $createdConn[0];
        }
    }
    public function createSelectTransaction(int $user_id){
        $createdConn = $this->createConn();
        if($createdConn[0] == null){
            try{
                $conn = &$createdConn[1];
                $conn->begin_transaction();
                $result = $conn->query("SELECT * FROM task WHERE user_id = '$user_id'");
                $conn->commit();
                $conn->close();
                return $result;
            }
            catch(Exception $e){
                $conn->rollback();
                $conn->close();
                return $e->getMessage();
            }
        }
        else{
            return $createdConn[0];
        }
    }
    public function createDeleteTransaction($task_id){
        $createdConn = $this->createConn();
        if($createdConn[0] == null){
            try{
                $conn = &$createdConn[1];
                $conn->begin_transaction();
                $conn->query("DELETE FROM task WHERE task_id = '$task_id'");
                $conn->commit();
                $conn->close();
                return true;
            }
            catch(Exception $e){
                $conn->rollback();
                $conn->close();
                return $e->getMessage();
            }
        }
        else{
            return $createdConn[0];
        }
    }
    public function createUpdateTransaction($task_id,$task_name,$task_text,$task_limit_date){
        $createdConn = $this->createConn();
        if($createdConn[0] == null){
            try{
                $conn = &$createdConn[1];
                $conn->begin_transaction();
                $conn->query("UPDATE task 
                            SET task_name = '$task_name', 
                                task_text = '$task_text', 
                                task_limit_date = '$task_limit_date'  
                            WHERE task_id = '$task_id'");
                $conn->commit();
                $conn->close();
                return true;
            }
            catch(Exception $e){
                $conn->rollback();
                $conn->close();
                return $e->getMessage();
            }
        }
        else{
            return $createdConn[0];
        }
    }
}