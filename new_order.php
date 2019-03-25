<?php
include_once("database/constants.php");
if (!isset($_SESSION["userid"]))
    header("location: index.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Stock Control System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <script type="text/javascript" src="js/order.js"></script>
</head>
<body>
<?php
//Nav bar
include_once("templates/header.php");
$last_login = $_SESSION["last_login"];
?>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                   <h4>New Order</h4>
                </div>
                <div class="card-body">
                    <form id="order_data" onsubmit="return false" target="_blank">
                        <div class="form-group row">
                            <label class="col-sm-3" align="right">Order Date</label>
                            <div class="col-sm-6">
                                <input type="text" id="order_date" name="order_date" readonly class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3" align="right">Customer Name*</label>
                            <div class="col-sm-6">
                                <input type="text" id="cust_name" name="cust_name" class="form-control form-control-sm" placeholder="Customer Name" required/>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h3>Choose Products</h3>
                                <div class="table-responsive">
                                    <table class="table" align="center">
                                        <thead>
                                       <tr>
                                            <th>#</th>
                                            <th style="text-align: center;">Item Name</th>
                                            <th style="text-align: center;">Total Quantity</th>
                                            <th style="text-align: center;">Quantity</th>
                                            <th style="text-align: center;">Price</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody id="invoice_item">
                                        <!-- <tr>
                                            <td><b id="number">1</b> </td>
                                            <td>
                                                <select name="pid[]" class="form-control form-control-sm" required>
                                                    <option>Example</option>
                                                </select>
                                            </td>
                                            <td><input name="total_qty[]" type="text" class="form control form-control-sm" readonly/> </td>
                                            <td><input name="qty[]" type="text" class="form control form-control-sm" required/> </td>
                                            <td><input name="price[]" type="text" class="form control form-control-sm" readonly/> </td>
                                            <td>£78</td>
                                        </tr>-->
                                    </tbody>
                                </table>
                                <center style="padding:3%;">
                                    <button id="add" style="width:18%;" class="btn btn-success">Add</button>
                                    <button id="remove" style="width:18%;" class="btn btn-danger">Remove</button>
                                </center>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    <div class="form-group row">
                        <label for="sub_total" class="col-sm-3" align="right">Sub Total</label>
                        <div class="col-sm-6">
                            <input type="text" readonly name="sub_total" class="form-control form-control-sm" id="sub_total" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tax" class="col-sm-3 col-form-label" align="right">Tax (18%)</label>
                        <div class="col-sm-6">
                            <input type="text" readonly name="tax" class="form-control form-control-sm" id="tax" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                        <div class="col-sm-6">
                            <input type="text" readonly name="net_total" class="form-control form-control-sm" id="net_total" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                        <div class="col-sm-6">
                            <input type="text" name="paid" class="form-control form-control-sm" id="paid" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                        <div class="col-sm-6">
                            <input type="text" readonly name="due" class="form-control form-control-sm" id="due" required/>
                        </div>
                    </div>
                    <center>
                        <input type="submit" id="order_form" style="width:18%;" class="btn btn-info" value="Order">
                        <input type="submit" id="print_invoice" style="width:18%;" class="btn btn-success d-none" value="Print Invoice">
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>