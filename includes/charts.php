<?php
session_start();
require_once('../database/db.php');
global $con;
//setting header to json
header('Content-Type: application/json');

//query to get data from the table
$sql = $con->query('SELECT pid, product_name, product_stock, stock_threshold FROM products WHERE product_stock < 60 ORDER BY product_stock');

//loop through the returned data
$data = array();
if ($sql !== false){
    foreach ($sql as $row) {
        $data[] = $row;
    }
}else{
    echo "the sql query failed with error ";
}


//free memory associated with result
$sql = null;

//close connection
$con = null;

//now print the data
print json_encode($data);
