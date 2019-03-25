<?php

define('hostname', 'localhost'); /* Your MySQL hostname.For example: 127.0.0.1 */
define('username', 'root'); /* Your MySQL username.For example: root */
define('password', ''); /* Your MySQL password.For example: 1234 */
define('database', ''); /* Your MySQL database.For example: smm */

/* PDO Connection */
$ClassPDO = new PDO_Connection();
$ClassPDO->SetConnection();
$con = $ClassPDO->GetConnection();


class PDO_Connection
{
    public $con;

    public $_hostname = hostname,
        $_username = username,
        $_password = password,
        $_database = database;

    function SetConnection()
    {
        try{
            $this->pdo = new PDO('mysql:host='.$this->_hostname.';dbname='.$this->_database.'', $this->_username, $this->_password);
        } catch(PDOException $ex){
            echo('MySQL connection is not configured correct.Check your MySQL connection settings.');
            exit();
        }
    }

    function GetConnection()
    {
        if(!empty($this->pdo))
        {
            return $this->pdo;
        } else {
            return false;
        }
    }
}


class Database {
    public $con;
    public function connect(){
        include_once("constants.php");
        $this->con = $db = new PDO('mysql:dbname='.DB.';host='.HOST, USER, PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        if ($this->con) {
            return $this->con;
        }

        return "DATABASE_CONNECTION_FAIL";
    }
}

?>