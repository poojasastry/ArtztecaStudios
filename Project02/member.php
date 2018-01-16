<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Displayed on the title bar -->
    <title>Member-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
  </head>
  <body>
    <?php
    #Print the member's last accessed IP and time
    if((isset($_SESSION['Authenticated']))&&($_SESSION["user_level"]=='member'))
    {
         require_once ("functions.php");
    }
    //Invoke the website header,footer and DB connect pages
    require 'includes/header.php';
    require_once("../config/site_connect.php");
    require 'includes/footer.php';
    #Invoke page to keep track of session activity
    include ("commons.php");
    #Only authenticated users can view member page
    if(isset($_SESSION["Authenticated"]))
    {
        if(isset($_POST['order'])) 
        {
            if(!isset($_POST['imageid']))
            {
                echo '<div class="alert alert-warning">Please select an artwork to purchase using the radio button</div>';
            }
            else
            {
                $imgid=$_POST["imageid"];
                $stmt2=$conn->prepare("SELECT Purchased FROM images WHERE imageid={$imgid}");
                $stmt2->execute();
                $rs2=$stmt2->fetch(PDO::FETCH_NUM);
                if ($rs2[0]=='Y')
                {
                    echo '<div class="alert alert-warning">Sorry! This artwork has already been purchased!</div>';
                }
                else
                {
                    $stmt1=$conn->prepare("UPDATE images SET Purchased='Y' WHERE imageid={$imgid}");
                    $rs=$stmt1->execute();
                    if($rs)
                    {
                        echo '<div class="alert alert-success">Congrats! You have succesfully placed an order!</div>';
                    }
                }
            }  
        }
        $sql="SELECT imageid,imagename,imagefile,userid,price,bestseller,Published,Purchased FROM images WHERE (Published='Y')";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
    }
    else
    {
        echo '<div class="alert alert-danger">You are not Authenticated to view this page</div>';
    }
    ?>

    <!--HTML form for Member page-->
    <div class="container-width">
    <?php if(isset($_SESSION['Authenticated'])) :?>
    <h2 class="text-center"><u> Published Artworks list:</u></h2>
    <form action="member.php" method="post">      
    <div class="table-responsive" style="padding: 0px 0px 0px 20px">
    <table class="table table-bordered table-hover table-condensed" style="width:auto !important" align="center">
    <thead> 
        <th> Artwork ID </th>
        <th> Artwork Name </th>
        <th> Artwork Image </th>
        <th> Artist ID </th>
        <th> Bestseller? </th>
        <th> Published? </th>
        <th> Purchased? </th>
        <th> Price </th>
        <th> Order </th>    
    </thead>
    <tbody>
    <?php while($result=$stmt->fetch(PDO::FETCH_ASSOC)) :?>
    <tr>
        <form action="member.php" method="POST">
            <td align="center"> <label class="radio"> 
            <input type="radio" name="imageid" value="<?php echo $result['imageid'];?>"><?php echo ($result['imageid']); ?></label></td>
            <td align="center"><?php echo ($result['imagename']); ?></td>
            <td align="center"><?php echo '<img src="'.$result['imagefile'].'" style="width:300px; max-height: 300px !important;" class="img-responsive"/>';?></td>
            <td align="center"><?php echo ($result['userid']) ?></td>
            <td align="center"><?php echo ($result['bestseller']) ?></td>
            <td align="center"><?php echo ($result['Published']) ?></td>
            <td align="center"><?php echo ($result['Purchased']) ?></td>
            <td align="center"><?php echo ($result['price']); ?></td>
            <td align="center"><button type="submit" name="order" class="btn btn-primary btn-sm">Order</button></td>
        </form>
    </tr>
    <?php endwhile;?>
    </tbody>
    </table>
    <?php endif;?>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="includes/bootstrap/js/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

