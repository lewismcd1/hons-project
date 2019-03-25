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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">    <script type="text/javascript" src="./js/main.js"></script>
</head>
<body>

<div class="container" style="margin-top: 2%;">
    <div class="card mx-auto" style="width: 30rem;">
        <div class="card-header">Register</div>
        <div class="card-body">
            <form id="form-register" onsubmit="return false" autocomplete="off">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter username"
                           />
                    <small id="u_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" id="email"
                           placeholder="Enter email" />
                    <small id="e_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="password1">Password</label>
                    <input type="password" name="password1" class="form-control" id="password1"
                           placeholder="Enter password" />
                    <small id="p1_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="password2">Re-enter Password</label>
                    <input type="password" name="password2" class="form-control" id="password2"
                           placeholder="Re-enter password" />
                    <small id="p2_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="usertype">User Type</label>
                    <select name="usertype" class="form-control" id="usertype" >
                        <option value="">Choose user type</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                    <small id="t_error" class="form-text text-muted"></small>
                </div>
                <button type="submit" name="user-register" class="btn btn-primary"><span class="fa fa-user"></span>
                    Register
                </button>
                <span><a href="index.php">Login</a> </span>
            </form>
        </div>
        <div class="card-footer text-muted"></div>
    </div>
</div>
</body>
</html>