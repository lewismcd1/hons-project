<?php
require_once("../database/db.php");

//User Class for registration and login
class User
{

    //Checks if user is already registered
    private function checkEmail($email)
    {
        global $con;
        $pre_stmt = $con->prepare("SELECT id FROM user WHERE email = ?");
        $pre_stmt->execute(array($email));
        return $pre_stmt->fetch();
    }

    public function createUserAccount($username, $email, $password, $usertype)
    {
        global $con;
        if ($this->checkEmail($email))
            return "EMAIL_EXISTS";
        else {
            $pass_hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);
            $date = date("Y-m-d");
            $notes = "";
            $pre_stmt = $con->prepare("INSERT INTO `user`(`username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES (?,?,?,?,?,?,?)");
            return $pre_stmt->execute(array($username, $email, $pass_hash, $usertype, $date, $date, $notes)) ? $this->con->lastInsertId() : "ERROR";
        }
    }

    public function userLogin($email, $password){
        global $con;
        $pre_stmt = $con->prepare("SELECT id,username,password,last_login,usertype FROM user WHERE email = ?");
        $pre_stmt->execute(array($email));
        $row = $pre_stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return "NOT_REGISTERED";
        }else{
            if(password_verify($password,$row["password"])){
                $_SESSION["userid"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["last_login"] = $row["last_login"];
                $_SESSION["usertype"] = $row["usertype"];
                //Updating last login time
                date_default_timezone_set('Europe/London');
                $last_login = date("d-m-Y h:m:s");
                $pre_stmt = $con->prepare("UPDATE user SET last_login = ? WHERE email = ?");
                return $pre_stmt->execute(array($last_login,$email));
            }else{
                return "INCORRECT_PASS";
            }
        }
    }
}
