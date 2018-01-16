<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--Displayed on the title bar -->
    <title>Login-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script>
    $('document').ready(function()
    { 
        $("#login-form").validate({
            rules: {
                email: {
                        required: true,
                    },
                    pwd: {
                        required: true,
                        minlength: 8,
                        maxlength: 12,
                    },
                },
                messages: {
                    pwd: {
                        required: "Please provide a password",
                        minlength: "Password at least have 8 characters",
                        maxlength: "Password cannot have more than 12 characters"
                    },
                    email:  {
                        required: "Please enter a registered email address",
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
        }); 
    });
    </script>
  </head>
  <body>
    <!--Invoke the website header page-->
    <?php require 'includes/header.php'; ?>
    <!--Invoke the website footer page-->
    <?php require 'includes/footer.php'; ?>
    <!--Invoke the DB connect page-->
    <?php require_once("../config/site_connect.php");
    #Invoke page to keep track of session activity
    include ("commons.php");?>
    <!--Login page content--> 
    <div class="container">
    <h3 class="text-info">Welcome to Login Page!</h3>
    <small class="text-primary"> <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> indicates a mandatory field. </small> <br><br>
        <!--Form handler for Login form-->
        <form action="loginhandler.php" method="post" id="login-form" class="form-horizontal">
        <div id="form-content">
        <fieldset>
        <!--Email-->
            <div class="form-group">
                <label for="Email" class="col-sm-2 control-label"> Email ID*</label>  
                <div class="col-sm-4">
                <input type="email" class="form-control" placeholder="Enter a valid email Address" name="email"> 
                </div> 
            </div>
        <!--Password-->
            <div class="form-group">
                <label for="Password" class="col-sm-2 control-label"> Password*<br></label>  
                <div class="col-sm-4">
                <input type="password" class="form-control" placeholder="Password" name="pwd" id="pwd"> 
                </div> 
            </div>
        <!--Checkbox-->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                <label><input type="checkbox"> Stay signed in </label>
                </div>
                </div>
            </div>
        <!--Submit button-->    
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">Login</button> 
                </div>
            </div>
        </fieldset>
        </div>
        </form>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="bootstrap/js/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>



