<?php
session_start();
require_once('../database/db.php');

// Checks
if (empty($_POST)) {
    returnData(Array("JSON" => 0, "Status" => 400, "Encode" => 0, "Data" => null));
}

if (empty($_POST['function'])) {
    returnData(Array("JSON" => 0, "Status" => 400, "Encode" => 0, "Data" => null));
}

// Return Function
function returnData($options)
{
    // Status Code
    if ($options["Status"] && $options["Status"] !== 0) {
        http_response_code($options["Status"]);
    }

    // Content Header
    if ($options["JSON"] === 1) {
        header('Content-Type: application/json');
    }

    // Encode Data
    if (!$options["Encode"] || $options["Encode"] !== 0) {
        echo json_encode($options["Data"]);
    } else {
        echo $options["Data"];
    }

    // End
    die();
}

// Clean input/output
function cleanInput($i)
{
    $i = strip_tags($i);
    $i = preg_replace('/[^\00-\255]+/u', '', $i);
    $i = stripslashes($i);
    return $i;
}

// Clean All Non Numbers
function cleanNA($i)
{
    return preg_replace('/[^0-9]/', '', $i);
}

// Clean All Non Alpha
function cleanNC($i)
{
    return preg_replace('/\PL/u', '', $i);
}

// Router
if ($_POST['function'] === 'getProduct') {
    getProduct();
} else if ($_POST['function'] === 'updateProduct') {
    updateProduct();
} else if ($_POST['function'] === 'createProduct') {
    createProduct();
} else {
    die();
}

// Get Product By Barcode 
function getProduct()
{
    // Variables 
    global $con;
    $product = null;
    $brands = Array();
    $categories = Array();

    // get brands  PDO  
    if ($stmt = $con->prepare("SELECT bid, brand_name, status FROM brands")) {
        $stmt->execute();
        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $brands[] = Array(
                'bid' => $rows['bid'],
                'brand_name' => $rows['brand_name'],
                'status' => $rows['status']);
        }
    } else {
        returnData(Array("JSON" => 0, "Status" => 200, "Encode" => 0, "Data" => false));
    }

    //Categories PDO Converstion 
    if ($stmt = $con->prepare("SELECT cid, parent_cat, category_name, status FROM categories"))
    {
        $stmt->execute();
        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $categories[] = Array(
                'cid' => $rows['cid'],
                'parent_cat' => $rows['parent_cat'],
                'category_name' => $rows['category_name'],
                'status' => $rows['status']);
        }
    } else {
        returnData(Array("JSON" => 0, "Status" => 200, "Encode" => 0, "Data" => false));
    }

    // Get Product PDO 
    if ($stmt = $con->prepare("SELECT pid, cid, bid, product_name, product_price, product_stock, added_date, p_status, barcode FROM `products` WHERE barcode = ? LIMIT 1"))
    {
        $result = $stmt->execute(array($_POST['barcode']));
        if ($result == true)
        {
            while ($rows = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $product = Array(
                    'pid' => $rows['pid'],
                    'cid' => $rows['cid'],
                    'bid' => $rows['bid'],
                    'product_name' => $rows['product_name'],
                    'product_price' => $rows['product_price'],
                    'product_stock' => $rows['product_stock'],
                    'added_date' => $rows['added_date'],
                    'p_status' => $rows['p_status'],
                    'barcode' => $rows['barcode']);
            }
        }
    } else {
        returnData(Array("JSON" => 0, "Status" => 200, "Encode" => 0, "Data" => false));
    }
    // Return 
    returnData(Array("JSON" => 1, "Status" => 200, "Encode" => 1, "Data" => Array("Status" => true, "Product" => $product, "Categories" => $categories, "Brands" => $brands)));
}

// Update Product 
function updateProduct()
{
    // Variables 
    global $con;
    // Checks 
    if (empty($_POST['barcode']) || !is_numeric($_POST['barcode']))
    {
        returnData(Array("JSON" => 0, "Status" => 400, "Encode" => 0, "Data" => false));
    }

    if (empty($_POST['cid']) || !is_numeric($_POST['cid']) || empty($_POST['bid']) || !is_numeric($_POST['bid']))
    {
        returnData(Array("JSON" => 0, "Status" => 400, "Encode" => 0, "Data" => false));
    }

    if (empty($_POST['product_name']) || empty($_POST['product_price']))
    {
        returnData(Array("JSON" => 0, "Status" => 400, "Encode" => 0, "Data" => false));
    }

    if (empty($_POST['product_stock']) || !is_numeric($_POST['product_stock']))
    {
        returnData(Array("JSON" => 0, "Status" => 400, "Encode" => 0, "Data" => false));
    }

    ////// Update  PDO  
    if ($stmt = $con->prepare("UPDATE products SET cid = ?, bid = ?, product_name = ?, product_price = ?, product_stock = ? WHERE barcode = ?")) {
        $result = $stmt->execute(array(cleanNA($_POST['cid']), cleanNA($_POST['bid']), cleanInput($_POST['product_name']), $_POST['product_price'], cleanNA($_POST['product_stock']), cleanNA($_POST['barcode'])));
        returnData(Array("JSON" => 0, "Status" => 200, "Encode" => 0, "Data" => true));
    } else {
        returnData(Array("JSON" => 0, "Status" => 200, "Encode" => 0, "Data" => false));
    }
}

function createProduct()
{
    // Checks 
    if (empty($_POST['cid']) || !is_numeric($_POST['cid']) || empty($_POST['bid']) || !is_numeric($_POST['bid'])) {
        returnData(Array("JSON" => 0, "Status" => 400, "Encode" => 0, "Data" => false));
    }
    if (empty($_POST['product_name']) || empty($_POST['product_price'])) {
        returnData(Array("JSON" => 0, "Status" => 400, "Encode" => 0, "Data" => false));
    }

    if (empty($_POST['product_stock']) || !is_numeric($_POST['product_stock'])) {
        returnData(Array("JSON" => 0, "Status" => 400, "Encode" => 0, "Data" => false));
    }

    // Variables 
    global $con;
    $cid = cleanNA($_POST['cid']);
    $bid = cleanNA($_POST['bid']);
    $product_name = cleanInput($_POST['product_name']);
    $product_price = str_replace(Array("$"), "", cleanInput($_POST['product_price']));
    $product_stock = cleanNA($_POST['product_stock']);
    $Barcode = $_POST['barcode'];
    $date = date("Y-m-d");

    //Insert PDO
    if ($stmt = $con->prepare("INSERT INTO products (cid, bid, product_name, product_price, product_stock, added_date, barcode) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
        $result = $stmt->execute(Array($cid, $bid, $product_name, $product_price, $product_stock, $date, $Barcode));
        if ($result == true) {
            returnData(Array("JSON" => 0, "Status" => 200, "Encode" => 0, "Data" => true));
        } else {
            returnData(Array("JSON" => 0, "Status" => 200, "Encode" => 0, "Data" => false));
        }
    } else {
        returnData(Array("JSON" => 0, "Status" => 400, "Encode" => 0, "Data" => false));
    }
}

?>
