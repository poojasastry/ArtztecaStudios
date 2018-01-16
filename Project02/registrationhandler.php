<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Displayed on the title bar -->
    <title>Register-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
  </head>
  <body>
  <?php
  //Invoke the website header,footer and DB connect pages
  require_once '../config/site_connect.php'; 
  require 'includes/header.php'; 
  require 'includes/footer.php'; 
  ?>
  <!--PHP form handling-->
  <div class="container"> 
    <?php 
      if(isset($_POST['submit']))
        {
          $stmt=$conn->prepare('SELECT * FROM login WHERE (email=:email)');
          $stmt->execute(array("email" => $_POST['email']));
          if(!empty($stmt->fetch(PDO::FETCH_ASSOC)))
            {
              echo '<div class="alert alert-danger">Sorry! Email already exists</div>';
            }
          else
            {
              $sql10="INSERT INTO login (first_name,last_name,dob,role,password,email) VALUES (:first_name,:last_name,:dob,:role,:password,:email)";
              $stmt10=$conn->prepare($sql10);
              date_default_timezone_set('America/Los_Angeles');
              $pwd=password_hash($_POST['pwd'],PASSWORD_DEFAULT);
              $rs=$stmt10->execute(array("first_name" => $_POST['First_Name'],"last_name" => $_POST['Last_Name'],
                  "dob" => $_POST['Date_Of_Birth'],"role"=>'member',"password" => $pwd,"email" => $_POST['email']));      
            }
          }          
   		    if(isset($rs)) :?>
          <div class="col-sm-8">     
          <div class="alert alert-success">
          <strong><span class="glyphicon glyphicon-ok"></span> Congratulations! You have registered succesfully! You may login using your credentials. </strong>
          </div>
          </div>
          <?php endif;?>
  </div><!-- /.container -->  
  <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="includes/bootstrap/js/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
  

