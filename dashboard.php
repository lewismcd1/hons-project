<?php
include_once("database/constants.php");
if (!isset($_SESSION["userid"])) {
    header("location: index.php");
}
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
    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/quagga.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/scan.js"></script>
    <script type="text/javascript" src="js/charts.js"></script>

    <style>
        #test video {
            background: rgba(0, 0, 0, 0.05);
            margin-bottom: 10px;
        }
        @media (max-width: 768px){
            .jumbotron{
                display: none;
            }
            #scan-barcode-modal{
                height: 85%;
            }
          
        }
        #chart-container{
            width: 40vw;
            height:30vh;
        }

    </style>
</head>
<body>
<?php
//Nav bar
include_once("templates/header.php");
$last_login = $_SESSION["last_login"];
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mx-auto" style="margin-bottom:2%;">
                <img class="card-img-top mx-auto" style="width: 60%; margin-top: 4%;" src="./images/login.png"
                     alt="Profile">
                <div class="card-body">
                    <h4 class="card-title">Profile Information</h4>
                    <p class="card-text"><i class="fa fa-user"></i> <?php echo $_SESSION["username"]; ?></p>
                    <p class="card-text"><i class="fa fa-user"></i> <?php echo $_SESSION["usertype"]; ?></p>
                    <p class="card-text">Last Login: <?php echo $last_login; ?></p>
                    <!--<a href="#" class="btn btn-primary"><i class="fa fa-edit"></i>Edit Profile</a>-->
                </div>
            </div>
        </div>
        <div class="col-md-8" style="margin-bottom:2%;border; 4px solid black">
            <div class="jumbotron" style="height: 103%; border; 4px solid black">
                <h1 class="display-4"> Welcome, <?php echo $_SESSION["username"]; ?>. </h1><br>
                <div class="row">
                    <div class="col-sm-6">
                        <div id="chart-container">
                            <canvas id="mycanvas" style="height: 50vh;width: 50vw;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card" style="margin-top: 3%;">
                        <div class="card-body">
                            <h4 class="card-title">Manage Products</h4>
                            <p class="card-text">Add and edit products</p>
                            <a class="btn btn-primary" style="color: #fff;" id='scan-barcode' data-toggle="modal" 
    data-target="#scan-barcode-modal">Scan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card" style="margin-top: 3%;">
                        <div class="card-body">
                            <h4 class="card-title">New Orders</h4>
                            <p class="card-text">Make invoices and create new orders.</p>
                            <a href="new_order.php" class="btn btn-primary">New Orders</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card" style="margin-top: 3%;">
                        <div class="card-body">
                            <h4 class="card-title">Manage Invoices</h4>
                            <p class="card-text">View and Download Invoices</p>
                            <a href="manage_invoice.php" class="btn btn-primary">Manage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p></p>
    <p></p>
    <?php
    include_once("templates/category.php");
    include_once("templates/brand.php");
    include_once("templates/products.php");
    include_once("templates/update_product.php");
    include_once("templates/scan.php");
    ?>
    <script>
        let modals = {
            "one": "PGgxPm1vZGFsPC9oMT4KPHA+dGhpcyBpcyB5b3VyIG1vZGFsPC9wPg=="
        }

        $("#close").onclick = () => {
            document.querySelector("#modal").style.display = "none";
        };

        let modal = (data) => {
            console.log(data);
            document.querySelector("#modal").style.display = "block";
            document.querySelector("#content").innerHTML = atob(data);
        };
    </script>

    <!-- Footer -->
    <footer class="page-footer">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2019 Lewis McDonald Honours Project</div>
    </footer>
</body>
</html>