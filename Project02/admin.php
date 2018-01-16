<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Displayed on the title bar -->
    <title>Admin page-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
  </head>

  <body>
    <?php 
    #Print the admin's last accessed IP and time
    if((isset($_SESSION['Authenticated']))&&($_SESSION["user_level"]=='admin'))
    {
        require_once ("functions.php");
    }
    #Invoke the website header,footer pages
    require 'includes/header.php';
    require 'includes/footer.php';
    #Invoke the page to connect to DB
    require_once("../config/site_connect.php");
    #Invoke page to keep track of session activity
    include ("commons.php");
    #Only authenticated users can view admin page
    if(isset($_SESSION["Authenticated"]))
    {
        echo '<h3 class="text-center"><b>Welcome to admin page!</b></h3>';
        if(isset($_POST["save"]))
        {
            if(!isset($_POST["userid"]))
            {
                echo '<div class="alert alert-warning">Please select the User using the radio button</div>';
            }
            elseif(empty($_POST["promote"]))
            {         
                echo '<div class="alert alert-warning">Please select from the dropdown a role to promote</div>';    
            }
            else
            {   
                $changedid=$_POST["userid"]; 
                $changerole=$_POST["promote"];
                $stmt1=$conn->prepare("UPDATE login SET role='$changerole' WHERE userid={$changedid}");
                $stmt1->execute();
            }       
        }
        
        #DB update if admin changes member to artist
        $sql="SELECT first_name,userid,role,email FROM login WHERE (role='member') ORDER BY userid";
        $stmt=$conn->prepare($sql);
        $stmt->execute();

        #DB update if admin changes artist to publisher
        $sql1="SELECT userid,first_name,role,email FROM login WHERE (role='artist') ORDER BY userid";
        $stmt1=$conn->prepare($sql1);
        $stmt1->execute();
    }
    else
    {
        echo '<div class="alert alert-danger">You are not Authenticated to view this page</div>';
    }
    
    ?>
    <!--Admin can promote to any role below theirs-->
    <div class="container">
    <?php if(isset($_SESSION['Authenticated'])) :?>
        <!--List of all current Members-->
        <h3 style="padding: 0px 0px 0px 20px" > <u> Members </u></h3>
        <form action="admin.php" method="post"> 
        <div class="table-responsive" style="padding: 0px 0px 0px 20px">
            <table class="table table-bordered table-hover table-condensed" style="width:auto !important"> 
            <thead>
                <th> User ID </th>
                <th> User </th>
                <th> Current Role </th>
                <th> Email ID </th>
            </thead>
            <tbody>
                <?php while($result=$stmt->fetch(PDO::FETCH_ASSOC)) :?>    
                <tr>
                <td align="center"><label class="radio"> 
                <input type="radio" name="userid" value="<?php echo $result['userid'];?>"><?php echo ($result['userid']) ?></label></td>   
                <td><?php echo ($result['first_name']) ?></td>    
                <td align="center"><?php echo ($result['role']) ?></td>
                <td align="center"><?php echo ($result['email']) ?></td> 
                </tr>                 
                <?php endwhile;?>  
            </tbody>
            <div class="form-group">
                <label for="newrole">Promote User?</label>             
                <select class="form-control" name="promote" style="width:auto !important"> 
                    <option value=""> Select </option>
                    <option value="artist">Artist</option> 
                    <option value="publisher">Publisher</option>          
                </select><br>
                <button type="submit" name="save" class="btn btn-primary btn-sm">Save</button>
            </div> 
            </table>
        </div>
        </form>
        <!--List of all current Artists-->
        <h3 style="padding: 0px 0px 0px 20px"> <u> Artists </u></h3>
        <form action="admin.php" method="post"> 
        <div class="table-responsive" style="padding: 0px 0px 0px 20px">
            <table class="table table-bordered table-hover table-condensed" style="width:auto !important">
            <thead>
                <th> User ID </th>
                <th> User </th>
                <th> Current Role </th>
                <th> Email ID </th>     
            </thead>
            <tbody>
                <?php while($result1=$stmt1->fetch(PDO::FETCH_ASSOC)) :?>
                <tr> 
                <td align="center"><label class="radio"> 
                <input type="radio" name="userid" value="<?php echo $result1['userid'];?>"><?php echo ($result1['userid']) ?></label></td>
                <td><?php echo ($result1['first_name']) ?></td>
                <td align="center"><?php echo ($result1['role']) ?></td>
                <td align="center"><?php echo ($result1['email']) ?></td>
                </tr>                 
                <?php endwhile;?>  
            </tbody>
            <div class="form-group">
            <label for="newrole">Promote User?</label>             
                <select class="form-control" name="promote" style="width:auto !important"> 
                    <option value=""> Select </option>
                    <option value="publisher">Publisher</option>          
                </select><br>
                <button type="submit" name="save" class="btn btn-primary btn-sm">Save</button>
            </div> 
            </table>
        </div>
        </form>
    <?php endif;?>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="includes/bootstrap/js/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

