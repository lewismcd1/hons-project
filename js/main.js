$(document).ready(function () {
    $("#form-register").on("submit", function () {
        var status = true;
        var uname = $("#username");
        var email = $("#email");
        var password1 = $("#password1");
        var password2 = $("#password2");
        var type = $("#usertype");
 
        var email_patt = new RegExp(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
 
        if (uname.val() === "" || uname.val().length < 4) {
            uname.addClass("border-danger");
            $("#u_error").html("<span class='text-danger'>Please enter username (More than 4 characters)</span>");
            status = false;
        } else {
            uname.removeClass("border-danger");
            $("#u_error").html("");
        }
        // .test() for match in email pattern with email
        if (!email_patt.test(email.val())) {
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>Please enter a valid email</span>");
            status = false;
        } else {
            email.removeClass("border-danger");
            $("#e_error").html("");
        }
        if (password1.val().length < 6) {
            password1.addClass("border-danger");
            $("#p1_error").html("<span class='text-danger'>Please enter a password (More than 6 characters)</span>");
            status = false;
        } else {
            password1.removeClass("border-danger");
            $("#p1_error").html("");
        }
 
        if (password2.val().length < 6) {
            password2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Please enter a password (More than 6 characters)</span>");
            status = false;
        } else {
            password2.removeClass("border-danger");
            $("#p2_error").html("");
        }
 
        if (type.val() === "") {
            type.addClass("border-danger");
            $("#t_error").html("<span class='text-danger'>Please choose an account type</span>");
            status = false;
        } else {
            type.removeClass("border-danger");
            $("#t_error").html("");
        }
        if(status){
            $.ajax({
                url: "includes/process.php",
                method: "POST",
                data: $("#form-register").serialize(),
                success: function (data) {
                    if (data === "EMAIL_EXISTS") {
                        alert("Your email already exists.");
                    } else if (data === "ERROR") {
                        alert("Oops, Something went wrong.");
                    }else if (status === false){
                        alert ("There was an error.");
                    }
                    else {
                        console.log(data);
                         window.location.href = encodeURI("index.php?msg=Registration successful");
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.error(xhr.status);
                    console.error(thrownError);
                }
            });
          }
          return false;
    });

    //Login page
    $("#form-login").on("submit", function () {
        var email = $("#log_email");
        var password = $("#log_password");
        var status = false;
        if (email.value === '') {
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>Please Enter Email Address</span>");
            status = false;
        } else {
            email.removeClass("border-danger");
            $("#e_error").html("");
            status = true;
        }
        if (password.val() === "") {
            password.addClass("border-danger");
            $("#p_error").html("<span class='text-danger'>Please enter your password.</span>");
            status = false;
        } else {
            password.removeClass("border-danger");
            $("#p_error").html("");
            status = true;
        }
        if (status) {
            $.ajax({
                url : "includes/process.php",
                method : "POST",
                data : $("#form-login").serialize(),
                success : function (data) {
                    if (data == "NOT_REGISTERED") {
                        email.addClass("border-danger");
                        $("#e_error").html("<span class='text-danger'>You are not registered.</span>");
                    } else if (data == "INCORRECT_PASS") {
                        password.addClass("border-danger");
                        $("#p_error").html("<span class='text-danger'>Please enter correct password.</span>");
                        status = false;
                    } else {
                        console.log(data);
                        window.location.href = "dashboard.php";
                    }
                }
            })
        }
    })

   });