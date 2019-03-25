<?php
include_once ("./database/constants.php");
if (isset($_SESSION["userid"]))
    foreach($_SESSION as $key => $value)
        unset($_SESSION[$key]);
header("location: index.php");

?>