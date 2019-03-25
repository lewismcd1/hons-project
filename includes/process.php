<?php
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");

$user = new User();

//Reset password processing
/*if(isset($_POST["recover_email"])){
    $m = new Manage();
    $m->resetPassword($_POST["recover_email"]);
}else{
    return "NOT_EXISTS";
}*/

//Registration page processing
if (isset($_POST["username"]) AND isset($_POST["email"])) {
    $result = $user->createUserAccount($_POST["username"],
        $_POST["email"],
        $_POST["password1"],
        $_POST["usertype"]);
    echo $result;
    echo "username";
    exit();
}

//Login page processing
if (isset($_POST["log_email"]) AND isset($_POST["log_password"])) {
    $result = $user->userLogin($_POST["log_email"], $_POST["log_password"]);
    echo $result;
    exit();
}

//To get category
if (isset($_POST["getCategory"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecords("categories");
    foreach ($rows as $row) {
        echo "<option value='" . $row["cid"] . "'>" . $row["category_name"] . "</option>";
    }
    exit();
}

//To get brand
if (isset($_POST["getBrand"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecords("brands");
    foreach ($rows as $row) {
        echo "<option value='" . $row["bid"] . "'>" . $row["brand_name"] . "</option>";
    }
    exit();
}

//Add category
if (isset($_POST["category_name"]) AND isset($_POST["parent_cat"])) {
    $obj = new DBOperation();
    $result = $obj->addCategory($_POST["parent_cat"], $_POST["category_name"]);
    echo $result;
    exit();
}

//Add brand
if (isset($_POST["brand_name"])) {
    $obj = new DBOperation();
    $result = $obj->addBrand($_POST["brand_name"]);
    echo $result;
    exit();
}

//Add product
if (isset($_POST["added_date"]) AND isset($_POST["product_name"])) {
    $obj = new DBOperation();
    $result = $obj->addProduct($_POST["select_cat"], $_POST["select_brand"], $_POST["product_name"],
        $_POST["product_price"], $_POST["product_qty"], $_POST["barcode"], $_POST["added_date"]);
    echo $result;
    exit();
}

//Manage category
if (isset($_POST["manageCategory"])) {
    $m = new Manage();
    $rows = $m->manageRecord("categories");
    if (count($rows) > 0) {
        foreach ($rows as $row) {
            ?>
            <tr>
                <td>..</td>
                <td><?php echo $row["category"]; ?></td>
                <td><?php echo $row["parent"]; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat"
                       style="margin:2%;">Delete</a>
                    <a href="#" eid="<?php echo $row['cid']; ?>" data-toggle="modal" data-target="#form-category-update"
                       class="btn btn-info btn-sm edit_cat" style="margin:2%;">Edit</a>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form-category">Add</a>
                </td>
            </tr>
            <?php
        }
        ?>

        <?php
        exit();
    }
}

//Delete category
if (isset($_POST["deleteCategory"])) {
    $m = new Manage();
    $result = $m->deleteRecord("categories", "cid", $_POST["id"]);
    echo $result;
}

//Edit category
if (isset($_POST["updateCategory"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("categories", "cid", $_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update category
if (isset($_POST["update_category_name"])) {
    $m = new Manage();
    $id = $_POST["cid"];
    $name = $_POST["update_category_name"];
    $parent = $_POST["update_parent_cat"];
    $result = $m->updateRecord("categories", ["cid" => $id], ["parent_cat" => $parent, "category_name" => $name, "status" => 1]);
    echo $result;
}


//------------------------- Brand ------------------------
//Manage brand
if (isset($_POST["manageBrand"])) {
    $m = new Manage();
    $rows = $m->manageRecord("brands");
    if (count($rows) > 0) {
        foreach ($rows as $row) {
            ?>
            <tr>
                <td>..</td>
                <td><?php echo $row["brand_name"]; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['bid']; ?>" class="btn btn-danger btn-sm del_brand"
                       style="margin:2%;">Delete</a>
                    <a href="#" eid="<?php echo $row['bid']; ?>" data-toggle="modal" data-target="#update-form-brand"
                       class="btn btn-info btn-sm edit_brand" style="margin:2%;">Edit</a>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form-brand">Add</a>
                </td>
            </tr>
            <?php

        }
        ?>
        <?php
        exit();
    }
}
//Delete brand
if (isset($_POST["deleteBrand"])) {
    $m = new Manage();
    $result = $m->deleteRecord("brands", "bid", $_POST["id"]);
    echo $result;
}

//Edit brand
if (isset($_POST["updateBrand"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("brands", "bid", $_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update brand
if (isset($_POST["update_brand_name"])) {
    $m = new Manage();
    $id = $_POST["bid"];
    $name = $_POST["update_brand_name"];
    $result = $m->updateRecord("brands", ["bid" => $id], ["brand_name" => $name, "status" => 1]);
    echo $result;
}

//----------------------------Products--------------------------
//Manage product
if (isset($_POST["manageProduct"])) {
    $m = new Manage();
    $rows = $m->manageRecord("products");
    if (count($rows) > 0) {
        foreach ($rows as $row) {
            ?>
            <tr>
                <td>..</td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo $row["category_name"]; ?></td>
                <td><?php echo $row["brand_name"]; ?></td>
                <td><?php echo $row["product_price"]; ?></td>
                <td><?php echo $row["product_stock"]; ?></td>
                <td><?php echo $row["added_date"]; ?></td>

                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product"
                       style="margin:2%;">Delete</a>
                    <a href="#" eid="<?php echo $row['pid']; ?>" data-toggle="modal" data-target="#update-form-product"
                       class="btn btn-info btn-sm edit_product" style="margin:2%;">Edit</a>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-products">Add</a>
                </td>
            </tr>
            <?php
        }
        ?>
        <?php

        exit();
    }
}

//Delete product
if (isset($_POST["deleteProduct"])) {
    $m = new Manage();
    $result = $m->deleteRecord("products", "pid", $_POST["id"]);
    echo $result;
}

//Edit product
if (isset($_POST["updateProduct"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("products", "pid", $_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update product
if (isset($_POST["update_product_name"])) {
    $m = new Manage();
    $id = $_POST["update_pid"];
    $name = $_POST["update_product_name"];
    $cat = $_POST["update_select_cat"];
    $brand = $_POST["update_select_brand"];
    $price = $_POST["update_product_price"];
    $qty = $_POST["update_product_qty"];
    $date = $_POST["update_added_date"];
    $result = $m->updateRecord("products", ["pid" => $id], ["cid" => $cat, "bid" => $brand, "product_name" => $name, "product_price" => $price, "product_stock" => $qty, "added_date" => $date]);
    echo $result;
}

//------------------------------ Order processing ----------------------


if (isset($_POST["getNewOrderItem"])) {
    $obj = new DBOperation();
    $rows = $obj->getActiveProducts();
    ?>
    <tr>
        <td><b class="number">1</b></td>
        <td>
            <select name="pid[]" class="form-control form-control-sm pid" required>
                <option value="">Choose Product</option>
                <?php
                foreach ($rows as $row) {
                    ?><option value="<?php echo $row['pid']; ?>"><?php echo $row["product_name"]; ?></option><?php
                }
                ?>
            </select>
        </td>
        <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm tqty"/></td>
        <td><input name="qty[]" type="text" class="form-control form-control-sm qty" required/></td>
        <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly/></span></td>
        <input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name"/>
        <td>£<span class="amt">0</span> </td>
    </tr>
    <?php
    exit();
}
//Get price and quantity of a single item
if (isset($_POST["getPriceAndQty"])){
    $m = new Manage();
    $result = $m->getSingleRecord("products", "pid", $_POST["id"]);
    echo json_encode($result);
    exit();
}

if(isset($_POST["order_date"]) AND isset($_POST["cust_name"])){
    $orderdate = $_POST["order_date"];
    $custname = $_POST["cust_name"];


    //Get array from order form
    $ar_tqty = $_POST["tqty"];
    $ar_qty = $_POST["qty"];
    $ar_price = $_POST["price"];
    $ar_proname = $_POST["pro_name"];

    $sub_total = $_POST["sub_total"];
    $tax = $_POST["tax"];
    $net_total = $_POST["net_total"];
    $paid = $_POST["paid"];
    $due = $_POST["due"];

    $m = new Manage();
    echo $result = $m->storeInvoice($orderdate,$custname,$ar_tqty,$ar_qty,$ar_price,$ar_proname,$sub_total,$tax,$net_total,$paid,$due);

}

//------------------------- Invoice ------------------------
//Manage invoices
if (isset($_POST["manageInvoice"])) {
    $m = new Manage();
    $rows = $m->manageRecord("invoice");
    if (count($rows) > 0) {
        foreach ($rows as $row) {
                ?>
                <tr>
                    <td>..</td>
                    <td><?php if (!$row["customer_name"] == ''){
                        echo $row["customer_name"];
                        }else{
                        echo "NO NAME GIVEN";
                        } ?>
                    </td>
                    <td>
                        <?php if ($row["order_date"] != "0000-00-00"){
                            echo $row["order_date"];
                        }else{
                            echo "INVALID_DATE";
                        }
                ?>

                    </td>
                    <td><?php echo $row["sub_total"]; ?></td>
                    <td><?php echo $row["tax"]; ?></td>
                    <td><?php echo $row["net_total"]; ?></td>
                    <td><?php echo $row["paid"]; ?></td>
                    <td><?php echo $row["due"]; ?></td>
                    <!--<td>
                        <a href="#" iid="<?php echo $row['invoice_no']; ?>" class="btn btn-danger btn-sm del_invoice"
                           style="margin:2%;">Delete</a>
                    </td>-->
                </tr>
                <?php
        }
        ?>
        <?php
        exit();
    }
}

//Delete product
if (isset($_POST["deleteInvoice"])) {
    $m = new Manage();
    $result = $m->deleteRecord("invoice_details", "id", "iid");
    $result = $m->deleteRecord("invoice","invoice_no", "iid");
    echo $result;
}
?>