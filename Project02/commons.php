<?php 
	#Keep track of session
 	if(isset($_SESSION['first_name']))
	{
	 	if( (time()-$_SESSION['last_activity'])>$_SESSION['expire'] ) 
	 	{ 
        ob_start();
    	echo"<script>alert('Your session has expired!Please login again');</script>";
    	unset($_SESSION['first_name'], $_SESSION['last_activity'], $_SESSION['Authenticated']);
        session_destroy();
        echo("<script>location.href = 'login.php';</script>");
        ob_end_flush();
    	exit();
    	}
   		else
    	{
    		$_SESSION['last_activity'] = time();
		}
	}
define("VISITOR",0);
define("MEMBER",10);
define("ARTIST",40);
define("PUBLISHER",80);
define("ADMIN",100);
?>