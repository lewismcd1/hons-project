<?php
session_name("SESSION");
session_start();
require_once('db.php');

if(isset($_SESSION['last_activity'],$_SESSION['userid']) && (time()-$_SESSION['last_activity'])>100*10)
{
    unset($_SESSION['userid']);
    header("location: index.php");
    exit;
}

$_SESSION['last_activity'] = time();

//define("DOMAIN","http://hons-project.000webhostapp.com/public_html");
?>
