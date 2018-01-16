<?php 
require_once("../config/site_connect.php");
    #Print the user's last accessed IP and time
    if(isset($_SESSION['Authenticated']))
    {
        date_default_timezone_set('America/Los_Angeles');   
        $expiry=time()+60*60*24;
            if(!isset($_COOKIE["last_accessed_time"])) 
            {
                setcookie("last_accessed_time",date('m/d/Y H:i:s'),$expiry);
            }
            else
            {
                echo "Cookie info: ";
                $last_accessed_time=$_COOKIE["last_accessed_time"];
                echo "Time you last accessed our site at: ".$last_accessed_time;
                echo "<br>";
                setcookie("last_accessed_time",date('m/d/Y H:i:s'),$expiry);
            }
            if(!isset($_COOKIE["last_accessed_IP"]))
            {
                setcookie("last_accessed_IP",$_SERVER['REMOTE_ADDR'],$expiry);
            }
            else
            {
                $last_accessed_IP=$_COOKIE["last_accessed_IP"];
                echo "Last time you accessed our site from: ".$last_accessed_IP." IP address";
                setcookie("last_accessed_IP",$_SERVER['REMOTE_ADDR'],$expiry);
            }
    }   
?>