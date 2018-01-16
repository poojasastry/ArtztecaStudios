<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Displayed on the title bar -->
    <title>Artist page-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  </head>
  <body>  
    <?php 
    #Print the artist's last accessed IP and time
    if((isset($_SESSION['Authenticated']))&&($_SESSION["user_level"]=='artist'))
    {
      require_once ("functions.php");
    }
    #Invoke the website header,footer and DB connect pages
    require 'includes/header.php';
    require_once("../config/site_connect.php");
    require 'includes/footer.php';
    #Invoke page to keep track of session activity
    include ("commons.php");
    #Only authenticated users can view artist page
    if(isset($_SESSION["Authenticated"]))
      {
        #Artist can delete his artwork
        if(isset($_POST['delete']))
          {
            if(!isset($_POST['imageid']))
              {
                echo '<div class="alert alert-warning">Please select the artwork to delete using the radio button</div>';
              }
              else
              {
                $imgid=$_POST["imageid"];
                $userid=$_SESSION["user_id"];
                $role=$_SESSION["user_level"];
                $stmt10=$conn->prepare("SELECT userid FROM images WHERE imageid=$imgid");
                $stmt10->execute();
                $rs10=$stmt10->fetch();
                if(($rs10[0]==$userid)||($role=="publisher")||($role=="admin"))
                  {
                    $stmt1=$conn->prepare("DELETE FROM images WHERE imageid={$imgid}");
                    $rs=$stmt1->execute();
                    if($rs)
                    {
                      echo '<div class="alert alert-success">You have deleted the artwork</div>';
                    }
                  } 
                  else
                  {
                    echo '<div class="alert alert-danger">You are not permitted to delete work of another artist</div>';
                  } 
              }
          }
          #Artist can edit his artwork
          if(isset($_POST['edit']))
            {
              if(!isset($_POST['imageid']))
                {
                  echo '<div class="alert alert-warning">Please select the artwork to edit, using the radio button!</div>';
                }
              elseif(empty($_POST['imagename']))
                {
                  echo '<div class="alert alert-warning">Please enter a new artwork name!</div>';
                }
              else
                {
                  $newimgname=$_POST['imagename'];
                  $imgid=$_POST["imageid"];
                  $userid=$_SESSION["user_id"];
                  $role=$_SESSION["user_level"];
                  $stmt10=$conn->prepare("SELECT userid FROM images WHERE imageid=$imgid");
                  $stmt10->execute();
                  $rs10=$stmt10->fetch();
                  if(($rs10[0]==$userid)||($role=="publisher")||($role=="admin"))
                  {                 
                    $sql2="UPDATE images SET imagename='$newimgname' WHERE imageid={$imgid}";
                    $stmt=$conn->prepare($sql2);
                    $rs2=$stmt->execute();
                    if($rs2)
                    {
                     echo '<div class="alert alert-success">You have edited the artwork</div>';
                    } 
                  }
                  else
                  {
                    echo '<div class="alert alert-danger">You are not permitted to edit work of another artist!</div>';
                  }
                }
            }

          #Artist can upload new artwork
          if(isset($_POST['submit']))
          {
            $userid=$_SESSION["user_id"];
            $imageName = $_POST['imagename'];
            if(!empty($imageName))
            {
              $cd = __DIR__;
              $target_dir =  $cd .'/tmpmedia/';
              $target_file = $target_dir . basename($_FILES["image"]["name"]);
              $save_fileas= 'tmpmedia/'. basename($_FILES["image"]["name"]);
              if(!empty($target_file))
              {
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $imageType = $_FILES["image"]["type"];
                if(substr($imageType,0,5)=="image")
                {
                  if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
                  {
                    $dbQuery = $conn->prepare("INSERT INTO images ( imagename,imagefile,userid,bestseller,Published,Purchased) VALUES 
                      ('$imageName', '$save_fileas','$userid','N','N','N')");
                    $dbQuery->execute();
                    echo '<div class="alert alert-success">Artwork uploaded succesfully!</div>';
                  }
                }
                else
                {
                  echo '<div class="alert alert-danger">Only images are allowed</div>';
                } 
              }
              else
              {
                echo '<div class="alert alert-warning">Please select an image</div>';
              }
            }
            else
            {
              echo '<div class="alert alert-warning">Please add a name to the artwork</div>';
            }
          }            
      }
      else
      {
        echo '<div class="alert alert-danger">You are not Authenticated to view this page</div>';
      }
    ?>
      
      <!--HTML form to add new artwork-->
      <div class="container">
      <?php if(isset($_SESSION['Authenticated'])) :?>
      <div class="main">
      <form id="uploadimage" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
      <h4 class="text-info"> <u> <b> Add New Artwork </b></u></h4>
      
      <div class="form-group">
      <label for="Image_Name" class="col-sm-2 control-label"> Artwork name*:</label>
      <div class="col-sm-4">
      <input type="text" name="imagename" id="imname" class="form-control" placeholder="Artwork name"required> 
      </div>
      </div>

      <div class="form-group">
      <label for="thumbnail_size" class="col-sm-2 control-label">Upload:</label>
      <div class="col-sm-4 ">
      <input type="file" name="image" id="file" accept=".jpg" required/> </div>
      </div>
      
      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" name="submit" value="Add Artwork" class="submit" />
      </div>
      </div>
      </form>
      
      </div>
      <?php endif;?>
      </div>
      
      <div class="container-width">
      <?php
        #Display artwork list
        if(isset($_SESSION['Authenticated']))
        {
          $userid=$_SESSION["user_id"];
          $sql="SELECT imageid,imagename,imagefile,userid,price FROM images";
          $stmt=$conn->prepare($sql);
          $stmt->execute();
        }
      ?>
      <div class="table-responsive" style="padding: 0px 0px 0px 20px">
      <?php if(isset($_SESSION['Authenticated'])) :?>
      <br>
      <table class="table table-bordered table-hover table-condensed" style="width:auto !important">
      <thead>
        <th> Artwork ID </th>
        <th> Artwork Name </th>
        <th> Artwork Image </th>
        <th> Artist ID </th> 
        <th> Price </th>
        <th> Edit/Delete Artwork </th> 
      </thead>
      <tbody>
      <?php while($result=$stmt->fetch(PDO::FETCH_ASSOC)) :?>
      <tr>
      <form action="artist.php" method="POST">
         
        <td align="center"> <label class="radio"> 
        <input type="radio" name="imageid" value="<?php echo $result['imageid'];?>" required><?php echo ($result['imageid']); ?></label></td>
        
        <td align="center">
        <input type="text" name="imagename" placeholder="<?php echo ($result['imagename']); ?>"></td>

        <td align="center"><?php echo '<img src="'.$result['imagefile'].'"class="img-responsive"/>';?></td>

        <td align="center"><?php echo ($result['userid']) ?></td>

        <td align="center"> <?php echo ($result['price']); ?></td>

        <td align="center"><button type="submit" name="edit" class="btn btn-primary btn-sm">Save Changes</button><br><br>
        <button type="submit" name="delete" class="btn btn-primary btn-sm">Delete Artwork</button></td>
      </form>
      </tr>
      <?php endwhile;?> 
      </tbody>
      </table>
      <br><br>
      <?php endif;?>    
      </div>
      </div>

      <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="includes/bootstrap/js/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>