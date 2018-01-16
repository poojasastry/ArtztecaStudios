<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Displayed on the title bar -->
    <title>Home-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
    </head>
    <body>
    <?php
    #Keep track of the number of times an unauthenticated user has viewed home page, using a cookie
    if(!isset($_SESSION['Authenticated']))
    {
       if (!isset($_COOKIE["ct"]))
        {
            echo "Cookies are enabled on this site! ";
            $_COOKIE["ct"]=0;
            $ct = $_COOKIE["ct"] + 1;
            setcookie("ct", $ct,time()+60*60*24,'/');
        }
        else
        {
            $ct = ++$_COOKIE["ct"];
            echo "Cookie info: This page has been viewed ".$_COOKIE["ct"]."times"; 
            setcookie("ct",$ct,time()+60*60*24,'/'); 
        }
    }
    #Invoke the website header,footer and DB connect pages
    require 'includes/header.php';
    require 'includes/footer.php'; 
    require_once("../config/site_connect.php");
    #Invoke page to keep track of session activity
    include ("commons.php");
    #Invoke home page content from DB
    $sql='SELECT * from pages where pageid=1';
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    echo $result['body'];
    #Retrieve artworks which are published and available for purchase
    $field = 'imageid';
    $sort = 'ASC';
    if(isset($_GET['field']))
    {
        $field=$_GET['field'];
    }
    #Pagination
    $limit = 2;
    if(isset($_GET['p']))
    {
        $page = $_GET['p'];
        $start=$limit*($page-1);
    }
    else
    {
        $page=1;
        $start=0;
    }

    $sql1="SELECT imageid,imagename,imagefile,userid,price FROM images WHERE (Published='Y' && Purchased='N') ORDER BY $field $sort limit $start,$limit";
    $stmt1=$conn->prepare($sql1);
    $stmt1->execute();

    $stmt2=$conn->prepare("SELECT imageid,imagename,imagefile,userid,price FROM images WHERE (Published='Y' && Purchased='N')");
    $stmt2->execute();
    $total=$stmt2->rowCount();
    $maxpage=ceil($total/$limit);

    function pagination($maxpage,$page,$field)
        {        
            echo '<div class="container">';    
            echo '<ul class="pagination" >';
            for($i=1;$i<=$maxpage;$i++)
            {
                echo '<li><a href=".?p='.$i.'&field='.$field.'">'.$i.'</a></li>';
                echo " ";
            }
            echo '</ul>';            
            echo '</div>';
        }
    ?>
    <div class="container">
        <h3 class="text-center"><b><u>Published artworks available for purchase</u></b></h3> 
        <?php pagination($maxpage,$page,$field);?>   
        <div class="table-responsive" style="padding: 0px 0px 0px 20px">
        <table class="table table-bordered table-hover table-condensed" style="width:auto !important" align="center">
        <thead>
            <th><a href=".?field=imageid">Artwork ID</a></th>
            <th><a href=".?field=imagename">Artwork Name</a></th>
            <th>Artwork Image</th>
            <th><a href=".?field=userid">Artist ID</a></th>
            <th><a href=".?field=price">Price (in $)</a></th>
        </thead>
        <tbody>
        <?php while($result1=$stmt1->fetch(PDO::FETCH_ASSOC)) :?>
            <tr>
            <td align="center"><?php echo $result1['imageid'];?></td>
            <td align="center"><?php echo ($result1['imagename']); ?></td>
            <td align="center"><?php echo '<img src="'.$result1['imagefile'].'" style="width:300px; max-height: 300px !important;" class="img-responsive"/>';?></td>
            <td align="center"><?php echo ($result1['userid']) ?></td>
            <td align="center"><?php echo ($result1['price']); ?></td>
            </tr>
        <?php endwhile;?>
        </tbody>
        </table>   
        </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="includes/bootstrap/js/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>