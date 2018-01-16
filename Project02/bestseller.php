    <?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Displayed on the title bar -->
    <title>Best Seller-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
  </head>
  <body>
    <?php 
    #Print the cookies set for Best Seller page for an unauthenticated user
    if(!isset($_SESSION['Authenticated']))
        {
            $expiry=time()+60*60*24;
            if(!isset($_COOKIE["count_bs"]))
            {
                echo "Cookies are enabled on this site. ";
                echo "Welcome! This is the first time you have viewed this page."; 
                $cookie = 1;
                setcookie("count_bs",$cookie,$expiry);
            }
            else
            {
                echo "Cookies are enabled ";
                $cookie = ++$_COOKIE['count_bs'];
                setcookie("count_bs", $cookie,$expiry); 
                echo "You have viewed this page ".$_COOKIE['count_bs']." times."; 
            }
        }
    #Invoke the website header,footer and DB connect pages
    require 'includes/header.php';
    require_once("../config/site_connect.php");
    require 'includes/footer.php';
    #Invoke page to keep track of session activity
    include ("commons.php");
    #Display the bestseller art list
    $sql="SELECT imageid,imagename,imagefile,userid,price,bestseller,Published,Purchased FROM images WHERE ((bestseller='Y')&&(Published='Y'))";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    ?>
    <!--HTML form for displaying the best seller list-->
    <div class="container-width">
        <h2 class="text-center"><u>Best Sellers List:</u> <small> Want to order them? Register at the earliest! </small></h2>
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
        </thead>
        <tbody>
        <?php while($result=$stmt->fetch(PDO::FETCH_ASSOC)) :?>
        <tr>
            <td align="center"><?php echo $result['imageid'];?></td>
            <td align="center"><?php echo ($result['imagename']); ?></td>
            <td align="center"><?php echo '<img src="'.$result['imagefile'].'" style="width:300px; max-height: 300px !important;" class="img-responsive"/>';?></td>
            <td align="center"><?php echo ($result['userid']) ?></td>
            <td align="center"><?php echo ($result['bestseller']) ?></td>
            <td align="center"><?php echo ($result['Published']) ?></td>
            <td align="center"><?php echo ($result['Purchased']) ?></td>
            <td align="center"><?php echo ($result['price']); ?></td>
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

