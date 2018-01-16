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
    <title>Register-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script>
    $('document').ready(function()
    { 
         $.validator.addMethod('rightemail',function(value,element){
                return this.optional(element)|| /^[a-zA-Z0-9\._\-]+[@][a-zA-Z]*[\.](com|gov|edu|org|mil|net)$/g.test(value);
            },"Not a valid email address format")

            $("#register-form").validate({
                rules: {
                    First_Name: "required",
                    email: {
                        required: true,
                        rightemail: true
                    },
                    pwd: {
                        required: true,
                        minlength: 8,
                        maxlength: 12,
                    },
                    Re_Password: {
                        required: true,
                        equalTo: "#pwd",
                        minlength: 8,
                        maxlength: 12,
                    },
                },
                messages: {
                    First_Name: "Please enter your firstname",
                    pwd: {
                        required: "Please provide a password",
                        minlength: "Password at least have 8 characters",
                        maxlength: "Password cannot have more than 12 characters"
                    },
                    Re_Password: {
                        required: "Please re-confirm the password",
                        equalTo: "Passwords don't match",
                        minlength: "Password at least have 8 characters",
                        maxlength: "Password cannot have more than 12 characters"
                    },
                    email:  {
                        required: "Please enter a valid email address",
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
    <?php require 'includes/footer.php'; 
    #Invoke the DB connect page
    require_once("../config/site_connect.php");
    #Invoke the page to maintain session activity
    include ("commons.php");?>
    <!--Register page content-->
    <div class="container">
        <h3 class="text-info">Welcome! Register to stay tuned about your favorite artists and their latest artworks! </h3>
        <small class="text-primary"> <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> indicates a mandatory field. </small> <br><br>
        <!--Form handler for Register form-->
        <form action="registrationhandler.php" method="post" id="register-form" class="form-horizontal">
        <div id="form-content">
            <fieldset>
           <!--First name-->
            <div class="form-group">
                <label for="First_Name" class="col-sm-2 control-label"> First Name* </label>    
                <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="First Name" name="First_Name"> 
                </div>
            </div>
            <!--Last name-->
            <div class="form-group">
                <label for="Last_Name" class="col-sm-2 control-label"> Last Name </label>   
                <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="Last Name" name="Last_Name"> 
                </div> 
            </div>
            <!--Email ID-->
            <div class="form-group">
                <label for="Email" class="col-sm-2 control-label"> Email ID*</label>  
                <div class="col-sm-4">
                <input type="email" class="form-control" placeholder="Enter a valid email Address" name="email"> 
                </div> 
            </div>
            <!--DOB-->
            <div class="form-group">
                <label for="Date_Of_Birth" class="col-sm-2 control-label"> Date Of Birth</label>    
                <div class="col-sm-4">
                <input type="date" class="form-control" placeholder="MM/DD/YYYY" max="2007/01/01" name="Date_Of_Birth">
                </div>
            </div>            
            <!--Fav color-->
            <div class="form-group">
                <label for="Fav Color" class="col-sm-2 control-label">Favorite color</label>  
                <div class="col-sm-4">
                <input type="color" class="form-control" placeholder="Favorite Color" name="favcolor"> 
                </div> 
            </div>
            <!--Password-->
            <div class="form-group">
                <label for="Password" class="col-sm-2 control-label"> Password*<br> </label>  
                <div class="col-sm-4">
                <input type="password" class="form-control" placeholder="Password" name="pwd" id="pwd"> 
                </div> 
            </div>
            <!--Re-enter Password-->
            <div class="form-group">
                <label for="Password" class="col-sm-2 control-label"> Confirm Password* </label>  
                <div class="col-sm-4">
                <input type="password" class="form-control" placeholder="Re-enter Password" name="Re_Password"> 
                </div> 
            </div>
            <!--Checkbox-->
            <div class="form-group">
                <div class="checkbox">
                    <div class="col-sm-offset-2 col-sm-10">
                    <label>
                    <input type="checkbox"> Email me about the latest Artzteca Studios news and events. </label>
                    </div>
                </div>
            </div>
            <!--Reset button-->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <button type="reset">Reset</button>
                </div>
            </div>
            <!--Submit button-->    
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">Sign Up</button> 
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


