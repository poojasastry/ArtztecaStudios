<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Displayed on the title bar -->
    <title>Art Event-ASC Inc.</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap sticky footer CSS -->
    <link href="includes/bootstrap/css/sticky-footer.css" rel="stylesheet">
  </head>

  <body>
    <?php 
        #Invoke the website header,footer 
        require 'includes/header.php';
        require 'includes/footer.php';
        #Invoke page to keep track of session activity
        include ("commons.php");
    ?>
    <!--Art Event page content-->
    <div class="container">
        <h3 class="text-info bg-info text-center"> <b>Check out our upcoming event schedule and meet your favorite artists! </b> </h3> <br>
        <!--Event 1-->
        <div class="media"> 
            <div class="media-body">
            <h4 class="media-heading" style="color:darkblue"> <b> <u>Still Life : </b> <i> Exhibition and workshop by Raja Ravi Varma </u></i><small> (Followed by High Tea)</small></h4>
            <p>Wednesday, May 4, 2016 <br>5:30 PM to 6:30 PM at San Diego Convention Center  </p>
            <h5 class="text-warning"><strong>Time until the next big art event:</strong></h5>
            <!--PHP code to display countdown to next event-->
            <?php
                  
                //Set Timezone to California
                date_default_timezone_set('America/Los_Angeles');
                //Capture current date and time
                $today= new DateTime();
                //Set event date and time    
                $eventdate= new Datetime();
                $eventdate->setDate(2016,5,4);
                $eventdate->setTime(17,30);
                //Calculate countdown
                $countdown=date_diff($today,$eventdate);
                //Display the countdown
                if(!($today>$eventdate))
                {
                    if(($countdown->format('%d')!=0)&&($countdown->format('%h')!=0))
                    {
                        echo $countdown->format('%d days, %h hours left !!');
                    }
                    else if(($countdown->format('%d')==0)&&($countdown->format('%h')!=0))
                    {
                        echo $countdown->format('Only %h hours %i minutes left !!');
                    }
                    else if(($countdown->format('%d')!=0)&&($countdown->format('%h')==0))
                    {
                        echo $countdown->format('%d days %i minutes left !!'); 
                    }
                    else if(($countdown->format('%d')==0)&&($countdown->format('%h')==0)&&($countdown->format('%i')!=0))
                    {
                        echo "Hurry! Only ";
                        echo $countdown->format('%i minutes left !!');
                    }
                }
                else 
                {
                    echo "You missed this event!";
                }
               // eval($phpCode);
            ?> 
            </div>
            <div class="media-right">
            <a href="#">
            <img src="includes/Images/ArtEventImage1.jpg" alt="Raja Ravi Varma Painting" style="width: 130px" class="img-responsive; img pull-right"/>
            </a>
            </div>
        </div> 
        <!--Event 2-->
        <div class="media">
            <div class="media-body">
            <h4 class="media-heading" style="color:darkblue"> <b><u> Art in Full Color : </b> <i> A talk by Vincent Van Gogh</u> </i></h4> 
            <p> Monday, May 9, 2016 <br>5:00 PM to 6:00 PM at San Diego Art Center </p>
            <h5 class="text-info"><strong>Time until the event:</strong></h5>
            <!--PHP code to display countdown to next event-->
            <?php
                //Set Timezone to California
                date_default_timezone_set('America/Los_Angeles');
                //Capture current date and time
                $today= new DateTime();
                //Set event date and time    
                $eventdate= new Datetime();
                $eventdate->setDate(2016,5,9);
                $eventdate->setTime(17,00);
                //Calculate countdown to event
                $countdown=date_diff($today,$eventdate);
                //Display the countdown
                if(!($today>$eventdate))
                {
                    if(($countdown->format('%d')!=0)&&($countdown->format('%h')!=0))
                    {
                        echo $countdown->format('%d days, %h hours left !!');
                    }
                    else if(($countdown->format('%d')==0)&&($countdown->format('%h')!=0))
                    {
                        echo $countdown->format('Only %h hours %i minutes left !!');
                    }
                    else if(($countdown->format('%d')!=0)&&($countdown->format('%h')==0))
                    {
                        echo $countdown->format('%d days %i minutes left !!'); 
                    }
                    else if(($countdown->format('%d')==0)&&($countdown->format('%h')==0)&&($countdown->format('%i')!=0))
                    {
                        echo "Hurry! Only ";
                        echo $countdown->format('%i minutes left !!');
                    }
                }
                else 
                {
                    echo "You missed this event!";
                }
            ?> 
            </div>
            <div class="media-right">
            <a href="#">
            <img src="includes/Images/ArtEventImage2.jpg" alt="Van Gogh Painting" style="width: 130px" class="img pull-right"/>
            </a>
            </div>
        </div>
    </div><!-- /.container --> 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="includes/bootstrap/js/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="includes/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>


