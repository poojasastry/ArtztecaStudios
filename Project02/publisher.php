<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Displayed on the title bar -->
    <title>Publisher-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
  </head>
  <body>
    <?php
    #Print the publisher's last accessed IP and time
    if((isset($_SESSION['Authenticated']))&&($_SESSION["user_level"]=='publisher'))
    {
        require_once ("functions.php");
    }
    #Invoke the website header,footer and DB connect pages
    require 'includes/header.php';
    require_once("../config/site_connect.php");
    require 'includes/footer.php';
    #Invoke page to keep track of session activity
    include ("commons.php");
    #Only authenticated users can view publisher page
    if(isset($_SESSION["Authenticated"]))
    {
        if(isset($_POST['save']))
            {
                if(!isset($_POST['imageid']))
                {
                    echo '<div class="alert alert-warning">Please select the artwork using the radio button</div>';
                }
                elseif(empty($_POST['price']))
                {
                    echo '<div class="alert alert-warning">Price cannot be zero</div>'; 
                }
                elseif(substr($_POST['price'], 0, 1) == "-")
                {
                    echo '<div class="alert alert-warning">Price cannot be negative</div>';
                }
                else
                {
                    $newprice=$_POST['price'];                               
                    $imgid=$_POST['imageid'];
                    $sql1="UPDATE images SET price='$newprice' WHERE imageid={$imgid}";
                    $stmt1=$conn->prepare($sql1);
                    $rs1=$stmt1->execute();
                }
            }
        if(isset($_POST['save2']))
            {
                if(!isset($_POST['imageid']))
                {
                    echo '<div class="alert alert-warning">Please select the artwork using the radio button</div>';
                } 
                elseif(empty($_POST['bestseller']))
                {
                    echo '<div class="alert alert-warning">Kindly mention if the artwork is a bestseller or not</div>';
                }
                elseif(($_POST['bestseller']!='Y')&&($_POST['bestseller']!='N'))
                {
                    echo '<div class="alert alert-warning">Bestseller value can be either Y or N only</div>';
                }
                else
                {
                    $newbestseller=$_POST['bestseller'];
                    $imgid=$_POST['imageid'];
                    $sql2="UPDATE images SET bestseller='$newbestseller' WHERE imageid={$imgid}";
                    $stmt2=$conn->prepare($sql2);
                    $rs2=$stmt2->execute();
                }
            }
        if(isset($_POST['save3']))
            {
                if(!isset($_POST['imageid']))
                {
                    echo '<div class="alert alert-warning">Please select the artwork using the radio button</div>';
                }
                elseif(empty($_POST['published']))
                {
                    echo '<div class="alert alert-warning">Kindly mention if the artwork is published or not</div>';
                }
                elseif(($_POST['published']!='Y')&&($_POST['published']!='N'))
                {
                    echo '<div class="alert alert-warning">Published value can be either Y or N only</div>';
                }    
                else
                {
                    $newpub=$_POST['published'];
                    $imgid=$_POST['imageid'];
                    $sql3="UPDATE images SET Published='$newpub' WHERE imageid={$imgid}";
                    $stmt3=$conn->prepare($sql3);
                    $rs3=$stmt3->execute();
                }
            }

        $sql="SELECT imageid,imagename,imagefile,userid,price,bestseller,Published FROM images";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
    }
    else
    {
        echo '<div class="alert alert-danger">You are not Authenticated to view this page</div>';
    }
    ?>
    <!--HTML form for Publisher page-->
    <div class="container-width">
    <?php if(isset($_SESSION['Authenticated'])) :?>
    <h2 class="text-center"><u> Welcome to Publisher page! </u></h2>
    <form action="publisher.php" method="post">      
    <div class="table-responsive" style="padding: 0px 0px 0px 20px">
    <table class="table table-bordered table-hover table-condensed" style="width:auto !important">
    <thead>
        <th> Artwork ID </th>
        <th> Artwork Name </th>
        <th> Artwork Image </th>
        <th> Artist ID </th>
        <th> Set/Edit Price </th>
        <th> Bestseller? (Y/N) </th>
        <th> Published? (Y/N) </th> 
    </thead>
    <tbody>
    <?php while($result=$stmt->fetch(PDO::FETCH_ASSOC)) :?>
        <tr>
        <form action="publisher.php" method="POST">
            <td align="center"> <label class="radio"> 
            <input type="radio" name="imageid" value="<?php echo $result['imageid'];?>"><?php echo ($result['imageid']); ?></label></td>

            <td align="center"><?php echo ($result['imagename']); ?></td>
            
            <td align="center"><?php echo '<img src="'.$result['imagefile'].'" style="width:300px; max-height: 300px !important;" class="img-responsive"/>';?></td>
            
            <td align="center"><?php echo ($result['userid']) ?></td>
            
            <td align="center">
            <input type="text" name="price" placeholder="<?php echo ($result['price']); ?>">
            <input type="submit" name="save" value="Save" /> </td>
            
            <td align="center">
            <input type="text" name="bestseller" placeholder="<?php echo ($result['bestseller']); ?>">
            <input type="submit" name="save2" value="Save" /> </td>

            <td align="center">
            <input type="text" name="published" placeholder="<?php echo ($result['Published']); ?>">
            <input type="submit" name="save3" value="Save" /></td>
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

