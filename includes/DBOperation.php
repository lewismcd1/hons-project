<?php
require_once("../database/db.php");

class DBOperation
{


    public function addCategory($parent, $cat)
    {
        global $con;
        $pre_stmt = $con->prepare("INSERT INTO `categories`(`parent_cat`, `category_name`, `status`) VALUES (?,?,?)");
        $status = 1;
        return $pre_stmt->execute(array($parent, $cat, $status)) ? "CATEGORY_ADDED" : 0;
    }

    public function getAllRecords($table)
    {
        global $con;
        $query = $con->query("SELECT * FROM $table");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return count($data) > 0 ? $data : "NO_DATA";
    }

    public function getActiveProducts(){
        global $con;
        $query= $con->query("SELECT * FROM products WHERE p_status = '1'");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return count($data) > 0 ? $data : "NO_DATA";
    }

    public function addBrand($brand_name)
    {
        global $con;
        $pre_stmt = $con->prepare("INSERT INTO `brands`(`brand_name`, `status`) VALUES (?,?)");
        $status = 1;
        return  $pre_stmt->execute(array($brand_name, $status)) ? "BRAND_ADDED" : 0;
    }

    public function addProduct($cid,$bid,$pro_name,$price,$stock, $barcode, $date){
        global $con;
        $pre_stmt = $con->prepare("INSERT INTO `products`(`cid`, `bid`, `product_name`, `product_price`, `product_stock`, `barcode`, `added_date`, `p_status`) VALUES (?,?,?,?,?,?,?,?)");
        $status = 1;
        return $pre_stmt->execute(array($cid, $bid,$pro_name,$price,$stock,$barcode,$date,$status)) ? "PRODUCT_ADDED" : 0;
    }
}

?>