<?php
include_once ("./database/constants.php");
if (isset($_SESSION["userid"]))
    header("location: dashboard.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Stock Control System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">    <link rel="stylesheet" type="text/css" href="./includes/style.css">
    <script type="text/javascript" rel="stylesheet" src="js/main.js"></script>
</head>
<body>
<br>

<div class="container" style="margin-top: 2%;">
    <?php
    if (isset($_GET["msg"]) AND !empty($_GET["msg"])) {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_GET["msg"]; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
    ?>
    <div class="card mx-auto" style="width: 20rem;">
        <img class="card-img-top mx-auto" style="width: 60%; margin-top: 1.5%; border-radius: 5px;"
             src="./images/login1.png" alt="Login">
        <div class="card-body">
            <form id="form-login" onsubmit="return false">
                <div class="form-group">
                    <label for="log_email">Email address</label>
                    <input type="email" class="form-control" name="log_email" id="log_email" placeholder="Enter email" />
                    <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.
                    </small>
                </div>
                <div class="form-group">
                    <label for="log_password">Password</label>
                    <input type="password" class="form-control" name="log_password" id="log_password"
                           placeholder="Password" />
                    <small id="p_error" class="form-text text-muted"></small>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-lock"></i> Login</button>
                <span><a href="registration.php">Register</a> </span>
            </form>
        </div>
        <div class="card-footer">
            <!--<a href="#">Reset Password</a>-->
        </div>
    </div>
</div>
</body>
</html>