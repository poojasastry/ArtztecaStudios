<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Displayed on the title bar -->
    <title>ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <div class="container-fluid" style="padding-right: 0 !important; padding-left: 0 !important; background-image:url(includes/Images/Image5.jpg)">
    <h1 class="text-center">ArtztecA Studios</h1>
  </div>

  	<nav class="navbar navbar-inverse">
     	<div class="container"> 
        	<div class="navbar-header">
          		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            	<span class="sr-only">Toggle navigation</span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
          		</button>
          		<?php 
          		  if(isset($_SESSION["Authenticated"])) :?>     
	           	  <li><a class="navbar-brand"><?php echo "Welcome ".$_SESSION['first_name']; ?></a></li>       

           		  <?php elseif ((isset($_SESSION["Authenticated"]))&&((time()-$_SESSION['last_activity'])>$_SESSION['expire'])) :?>
	              <li><a class="navbar-brand"><?php echo "You have been logged out." ?></a></li>

	              <?php else :?>
		            <li><a class="navbar-brand"><?php echo "Welcome guest! Please login"; ?></a></li>
       			    <?php endif; ?>
       		</div><!--/ .nav-header-->
        	<div id="navbar" class="collapse navbar-collapse">
        		<ul class="nav navbar-nav">
          		<li><a href="index.php"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home </a> </li>
           		
           		<li><a href="about.php"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> About</a></li>

           		<li><a href="bestseller.php">Best Seller</a> </li> 

           		<li><a href="artevent.php"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>Art Event </a> </li> 

           		<?php if((isset($_SESSION["Authenticated"]))&&($_SESSION["level"]>=10)):?>
           		<li><a href="member.php">Member</a></li>
           		<?php endif;?>

           		<?php if((isset($_SESSION["Authenticated"]))&&($_SESSION["level"]>=40)):?>
           		<li><a href="artist.php">Artist</a></li>
           		<?php endif;?>

           		<?php if((isset($_SESSION["Authenticated"]))&&($_SESSION["level"]>=80)):?>
           		<li><a href="publisher.php">Publisher</a></li>
           		<?php endif;?>

           		<?php if((isset($_SESSION["Authenticated"]))&&($_SESSION["level"]>=100)):?>
           		<li><a href="admin.php">Admin</a></li>
           		<?php endif;?>

           		</ul>
           		<ul class="nav navbar-nav navbar-right">
           		<li><a href="register.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Sign Up</a></li>
            	<li><a href="login.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Login</a></li>
            	<?php if(isset($_SESSION["Authenticated"])) :?>
          		<li><a href="<?php echo 'logout.php';?>"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li> 
        		<?php endif;?>
        		</ul>
        	</div>
        </div>		
    </nav>
     <!-- Bootstrap core JavaScript
    ================================================== -->
  	<script src="bootstrap/js/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
  	<script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>