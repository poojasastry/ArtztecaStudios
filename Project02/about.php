<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Displayed on the title bar -->
    <title>About-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
  </head>

  <body>
  	<?php 
      #Invoke the website header,footer and DB connect pages
      require 'includes/header.php';
      require 'includes/footer.php';
      require_once("../config/site_connect.php");
      #Invoke page to keep track of session activity
      include ("commons.php");
      #Invoke the About.php page contents from pages table in DB
      $sql='SELECT * from pages where pageid=2';
      $stmt=$conn->prepare($sql);
      $stmt->execute();
      $result=$stmt->fetch(PDO::FETCH_ASSOC);
  	  echo $result['body'];
  	?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="includes/bootstrap/js/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
	