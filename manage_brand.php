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
    <script src ="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" src="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <script type="text/javascript" src="js/manage.js"></script>
</head>
<body>
<?php
//Nav bar
include_once("templates/header.php");
$last_login = $_SESSION["last_login"];
?>
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered" id="brand_data">
            <thead>
            <tr>
                <th>#</th>
                <th>Brand</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="get_brand">
            <!-- <tr>
                 <td>1</td>
                 <td>Electronics</td>
                 <td>Root</td>
                 <td><a href="#" class="btn btn-success btn-sm">Active</a> </td>
                 <td>
                     <a href="#" class="btn btn-danger btn-sm">Delete</a>
                     <a href="#" class="btn btn-info btn-sm">Edit</a>
                 </td>
             </tr>-->
            </tbody>
        </table>
    </div>
</div>
<?php
include_once ("templates/brand.php");
include_once ("templates/update_brand.php");

?>

</body>
</html>