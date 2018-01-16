<?php
	#Start the session
	session_start();
	unset($_SESSION["user_id"]);
	session_unset();
	session_destroy();
	#Re-direct to index page
	ob_start();
	header("Location:.");
	ob_end_flush();
	exit();
?>