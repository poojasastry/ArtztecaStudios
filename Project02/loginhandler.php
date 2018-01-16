<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Displayed on the title bar -->
    <title>Login handler page-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
    </head>
    <body>
	<?php
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$page_title='Login page';
		#Invoke page to connect to DB
		require ('../config/site_connect.php');
		#Invoke page to keep track of session activity
		include ('commons.php');
		#Validate username/email
		if(!empty($_POST['email']))
		{
			$e=$_POST['email'];
			echo "<br>";
		}
		else
		{
			$e=FALSE;
			echo '<p class="error">You forgot to enter your email address</p>';
		}
		#Validate password
		if(!empty($_POST['pwd']))
		{
			$p=$_POST['pwd'];
			echo "<br>";
		}
		else
		{
			$p=FALSE;
			echo '<p class="error">You forgot to enter your password</p>';
		}
		if($e&&$p)
		{
			$hash=password_hash($p,PASSWORD_DEFAULT);
			try
			{
				$stmt=$conn->prepare('SELECT * FROM login WHERE email=:email');
				$stmt->execute(array('email'=>$e));
				$result=$stmt->fetch(PDO::FETCH_BOTH);
				if($stmt->rowCount()==1)
				{
					$dbhash=$result["password"];
					$pwmatch=password_verify($p,$dbhash);
					if($pwmatch)
					{
						date_default_timezone_set('America/Los_Angeles');	
						$_SESSION["errors"]='<p class="error">Email address and password matches</p>';
						$role=$result["role"];
						$_SESSION["user_id"]=$result["userid"];
						$_SESSION["user_level"]=$result["role"];
						$_SESSION["first_name"]=$result["first_name"];						
						switch($role)
						{													
							case "admin":
								$url="admin.php";
					 			$_SESSION["Authenticated"]=true;
					 			$_SESSION['last_activity']=time();
					 			$_SESSION['expire']=180;
					 			$_SESSION["level"]=100;
					 			break;
					 		case "member":
					 			$url="member.php";
					 			$_SESSION["Authenticated"]=true;
					 			$_SESSION['last_activity']=time();
					 			$_SESSION['expire']=180;
					 			$_SESSION["level"]=10;
					 			break;
					 		case "artist":
					 			$url="artist.php";
					 			$_SESSION["Authenticated"]=true;
					 			$_SESSION['last_activity']=time();
					 			$_SESSION['expire']=180;
					 			$_SESSION["level"]=40;
				 				break;
					 		case "publisher":
					 			$url="publisher.php";
					 			$_SESSION["Authenticated"]=true;	
					 			$_SESSION['last_activity']=time();
					 			$_SESSION['expire']=180;
					 			$_SESSION["level"]=80;
					 			break;
					 		default:
					 			$url="login.php";
						 		if(isset($_SESSION["Authenticated"]))
						 		{
						 			unset($_SESSION["Authenticated"]);
						 		}
						 		break;
						}
						unset($_SESSION["errors"]);
						header("Location:$url");
						exit();
					}
					else
					{
						$_SESSION["errors"]='<p class="error">Password does not match with the records. Please re-login.</p>';
					}
				}
				else
				{
					$_SESSION["errors"]='<p class="error">Email and password do not match with the records. Please login again!</p>';
				} 
			}
			catch(PDOException $e)
			{
				$_SESSION["errors"]='ERROR:'.$e->getMessage();
				echo '<hr>ERROR:'.$e->getMessage();
				echo "DB_USER=".DB_USER."<hr>";
				echo "DB_PASSWORD=".DB_PASSWORD."<hr>"; 
			}
		}
	}
	else
	{
		$_SESSION["errors"]='GET is not allowed on login page';
		$url="login.php";
		ob_clean();
		header("Location:$url");
		exit();
	}
	if(isset($_SESSION['errors']))
	{
		echo '<div class="alert alert-danger"> <strong>';
		echo $_SESSION['errors'];
		echo '</strong></div>';
	}
	?>
	</body>
</html>
