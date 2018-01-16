<?php
//error_reporting(E_ALL ^ E_WARNING);
$hostname=$GLOBALS['hostname']="localhost";
$dbname=$GLOBALS['dbname']="project2";
$username=$GLOBALS['username']="Project2";
$password=$GLOBALS['password']="pass02";

define("hostname",$GLOBALS['hostname'],true);
define("dbname",$GLOBALS['dbname'],true);
define("username",$GLOBALS['username'],true);
define("password",$GLOBALS['password'],true);

try
{
	$conn = new PDO('mysql:host='.$hostname.';dbname='.$dbname,$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//echo "Connected succesfully";
	$dbstatus=true;
}
catch(PDOException $e)
{
	$_SESSION["errors"]="Error".$e->getMessage();
	$dbstatus=false;
	echo $_SESSION["errors"];
}
	//Set Password Cost
	define("PASSWORD_COST",11);
?>