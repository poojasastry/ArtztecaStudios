-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2016 at 12:31 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imageid` int(12) NOT NULL,
  `imagename` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imagefile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userid` int(12) NOT NULL,
  `price` float NOT NULL,
  `bestseller` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `Published` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `Purchased` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `teaser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exifdata` text COLLATE utf8_unicode_ci NOT NULL,
  `GPSdata` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageid`, `imagename`, `imagefile`, `userid`, `price`, `bestseller`, `Published`, `Purchased`, `thumbnail`, `teaser`, `cover`, `exifdata`, `GPSdata`) VALUES
(1, 'Splash', 'tmpmedia/Artwork2.jpg', 2, 50, 'Y', 'Y', 'N', 'tmpmedia/Artwork2-thumb.jpg', 'tmpmedia/Artwork2-teaser.jpg', 'tmpmedia/Artwork2-cover.jpg', 'No exif data available for current artwork', 'No GPS data available'),
(2, 'Monalisa', 'tmpmedia/Artwork5.jpg', 24, 1000, 'N', 'Y', 'N', 'tmpmedia/Artwork5-thumb.jpg', 'tmpmedia/Artwork5-teaser.jpg', 'tmpmedia/Artwork5-cover.jpg', 'No exif data available for current artwork', 'No GPS data available'),
(84, 'Colorme', 'tmpmedia/Artwork7.jpg', 25, 100, 'Y', 'Y', 'N', 'tmpmedia/Artwork7-thumb.jpg', 'tmpmedia/Artwork7-teaser.jpg', 'tmpmedia/Artwork7-cover.jpg', 'No exif data available for current artwork', 'No GPS data available'),
(85, 'Forest', 'tmpmedia/Artwork9.jpg', 24, 25, 'Y', 'Y', 'Y', 'tmpmedia/Artwork9-thumb.jpg', 'tmpmedia/Artwork9-teaser.jpg', 'tmpmedia/Artwork9-cover.jpg', 'No exif data available for current artwork', 'No GPS data available'),
(86, 'Women''s day', 'tmpmedia/Artwork12.jpg', 2, 40, 'N', 'N', 'N', 'tmpmedia/Artwork12-thumb.jpg', 'tmpmedia/Artwork12-teaser.jpg', 'tmpmedia/Artwork12-cover.jpg', 'No exif data available for current artwork', 'No GPS data available'),
(87, 'Fusion', 'tmpmedia/Artwork1.jpg', 25, 75, 'N', 'Y', 'N', 'tmpmedia/Artwork1-thumb.jpg', 'tmpmedia/Artwork1-teaser.jpg', 'tmpmedia/Artwork1-cover.jpg', 'No exif data available for current artwork', 'No GPS data available'),
(90, 'arts', 'tmpmedia/Image3.jpg', 2, 100, 'Y', 'Y', 'N', 'tmpmedia/Image3-thumb.jpg', 'tmpmedia/Image3-teaser.jpg', 'tmpmedia/Image3-cover.jpg', 'No exif data available for current artwork', 'No GPS data available'),
(111, 'proj2', 'tmpmedia/Newimage.jpg', 2, 200, 'Y', 'N', 'N', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userid` int(12) NOT NULL,
  `first_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dob` text COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(254) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `first_name`, `last_name`, `dob`, `created`, `role`, `password`, `email`) VALUES
(1, 'account1', 'account1', '1970-01-24', '2016-03-24 07:00:00', 'publisher', '$2y$10$LB3sGV.K6Jxx01k0T6hTMe5TkHPGr6neCXi6oHIjWI4iIP9p6kRo2', 'acc1@gmail.com'),
(2, 'account2', 'account2', '2016-03-01', '2016-03-28 07:00:00', 'artist', '$2y$10$dE1HpSNlpIH9Bqm3YsXNfuICaJfJLnoYM.RP0ehyHlOTJy0QioPGO', 'acc2@gmail.com'),
(3, 'account3', 'account3', '2016-03-02', '2016-03-28 07:00:00', 'member', '$2y$10$tPe.zyAYXSqecCPI3xMfBucHbKR6BbOIIPuVByUwwp7bLD59inAHK', 'acc3@gmail.com'),
(4, 'account4', 'account4', '2016-03-03', '2016-03-28 07:00:00', 'admin', '$2y$10$ZLMuamsbIMRtq4etYyovEO1UhQm6l/wd3e1J3YQWKVyuhZZTeCrcy', 'acc4@gmail.com'),
(24, 'john', 'don', '2006-02-07', '2016-05-04 06:13:37', 'artist', '$2y$10$O8GIEm8GsQReLP6Xv/D4m.w1qQi26YTstr3/7Qmw.Kl/BzDb.g3zS', 'johndon@gmail.com'),
(25, 'michael', 'schumacher', '2004-11-16', '2016-05-04 06:17:12', 'artist', '$2y$10$VRuKw4XlI0fIzP6u5F8z2.UXeEqsqIGAvfZJKDC2uM9kQLoTmCLE.', 'michael@gmail.com'),
(26, 'asterix', 'obelix', '2004-02-26', '2016-05-04 18:20:35', 'admin', '$2y$10$6ejT0DSMAvpJFQUR8nogaOfIkygzGTSDg2b3Pkm2HTyR78/k9pPie', 'asterix@yahoo.com'),
(27, 'tom', 'cruise', '2006-03-08', '2016-05-04 22:29:38', 'member', '$2y$10$zIJbPSaRCuJZmVC2qzJNVOApK6Stbl6BL8WOTaIp41tcZNjeyRpIO', 'tomcruise@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pageid` int(12) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pageid`, `title`, `body`, `role`) VALUES
(1, 'index', '<div class="container-fluid" style="padding-right: 0 !important; padding-left: 0 !important;">\n      <!--Creating a carousel-->\n      <div id="myCarousel" class="carousel slide" data-ride="carousel" >\n        <!-- Indicators -->\n        <ol class="carousel-indicators">\n          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>\n          <li data-target="#myCarousel" data-slide-to="1"></li>\n          <li data-target="#myCarousel" data-slide-to="2"></li>\n          <li data-target="#myCarousel" data-slide-to="3"></li>\n        </ol>\n        <!-- Wrapper for slides -->\n        <div class="carousel-inner" role="listbox">\n          <!--Content for Slide 1-->\n          <div class="item active">\n            <img src="includes/Images/Image1.jpg" alt="abc" style="width:100%; max-height: 550px !important;" class="img-responsive">\n            <div class="carousel-caption">\n              <h1> <strong>Are you a budding artist</strong> <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></h1>\n            </div>\n          </div>\n          <!--Content for Slide 2-->\n          <div class="item">\n            <img src="includes/Images/Image2.jpg" alt="abc" style="width:100%; max-height: 550px !important;" class="img-responsive">\n            <div class="carousel-caption">\n              <h1> <strong>Do you want to promote art</strong> <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></h1>\n            </div>\n          </div>\n          <!--Content for Slide 3-->\n          <div class="item">\n            <img src="includes/Images/Image3.jpg" alt="abc" style="width:100%; max-height: 550px !important;" class="img-responsive">\n            <div class="carousel-caption">\n              <h1> <strong>Wish you knew artists better</strong> <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></h1>\n            </div>\n          </div>\n          <!--Content for Slide 4-->\n          <div class="item">\n            <img src="includes/Images/Image4.jpg" alt="abc" style="width:100%; max-height: 550px !important;" class="img-responsive">\n            <div class="carousel-caption">\n              <h1> <strong>Want to enter the world of art</strong> <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></h1>\n            </div>\n          </div>         \n          <!-- Controls -->\n          <!--Control for Previous icon-->\n          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">\n            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>\n            <span class="sr-only">Previous</span>\n          </a>\n          <!--Control for Next icon-->\n          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">\n            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>\n            <span class="sr-only">Next</span>\n          </a> \n        </div><!-- /.carousel-inner -->    \n      </div><!-- /.carousel slide -->   \n      <!--Text below the carousel--> \n      <h1 style="text-align:center"><strong> Art is now just a click away! <a href="register.php">Sign Up </a>now and stay connected!</strong></h1>\n    ', 'public'),
(2, 'About', '<!DOCTYPE html>\r\n<html lang="en">\r\n  <head>\r\n    <meta charset="utf-8">\r\n    <meta http-equiv="X-UA-Compatible" content="IE=edge">\r\n    <meta name="viewport" content="width=device-width, initial-scale=1">\r\n    <!--Displayed on the title bar -->\r\n    <title>About-ASC Inc.</title>\r\n    <!-- Bootstrap core CSS -->\r\n    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">\r\n    <!-- Bootstrap sticky footer CSS -->\r\n    <link href="bootstrap/css/sticky-footer.css" rel="stylesheet">\r\n  </head>\r\n\r\n  <body>\r\n    <!--Invoke the website header page-->\r\n  	<?php require ''includes/header.php'';?>\r\n    <!--Invoke the website footer page-->\r\n    <?php require ''includes/footer.php'';?>\r\n    <!--About page content-->\r\n    <div class="container">\r\n      <blockquote class="blockquote-reverse"> <i>Art washes away from the soul the dust of everyday life</i>\r\n      <footer> Pablo Picasso </footer>\r\n      </blockquote>\r\n      <!--Label for Our Mission-->\r\n      <h3><span class="label label-info">Our Mission</span></h3>\r\n      <!--Panel for Our Mission content-->\r\n      <div class="panel panel-info">\r\n        <div class="panel-body">\r\n        <p class="text-justify" style="color:grey"> At Artzteca Studios Co-operative, we believe that art conveys what words cannot, which is why our mission is to provide the right \r\n        opportunity for artists to publish and promote their artworks. We strive to provide a platform for the artists to work, to interact with fellow artists\r\n        and to get appreciation in the society, by displaying their work.\r\n        </p>\r\n        </div>\r\n      </div>\r\n      <!--Label for History-->\r\n      <h3><span class="label label-info">History</span></h3>\r\n      <!--Panel for History content-->\r\n      <div class="panel panel-info">\r\n        <div class="panel-body">\r\n        <p class="text-justify" style="color:grey"> In 2011, Artzteca Studios Co-operative was started by a group of individuals with keen interest\r\n        in promoting art in San Diego, California. By building an affordable studio, their goal was to encourage budding artists and connect them to the surrounding communties.\r\n        </p>\r\n        </div>\r\n      </div>\r\n      <!--Contact Information-->\r\n      <h5 class="text-center"><u><mark>Contact Us:</mark></u> </h5>\r\n      <address class="text-center">\r\n        <!--Name-->\r\n        <strong>Pooja Sastry </strong><br>\r\n        <!--Email address-->\r\n        <a href="mailto:#">sastry.pooja@gmail.com</a>\r\n      </address>\r\n    </div><!-- /.container --> \r\n    <!-- Bootstrap core JavaScript\r\n    ================================================== -->\r\n    <script src="bootstrap/js/jquery-1.12.0.min.js"></script>\r\n    <script>window.jQuery || document.write(''<script src="../../assets/js/vendor/jquery.min.js"><\\/script>'')</script>\r\n    <script src="bootstrap/js/bootstrap.min.js"></script>\r\n  </body>\r\n</html>\r\n	', 'public'),
(3, 'art event', '    <!DOCTYPE html>\r\n<html lang="en">\r\n  <head>\r\n    <meta charset="utf-8">\r\n    <meta http-equiv="X-UA-Compatible" content="IE=edge">\r\n    <meta name="viewport" content="width=device-width, initial-scale=1">\r\n    <meta name="description" content="">\r\n    <meta name="author" content="">\r\n    <!--Displayed on the title bar -->\r\n    <title>Art Event-ASC Inc.</title>\r\n    <!-- Bootstrap core CSS -->\r\n    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">\r\n    <!-- Bootstrap sticky footer CSS -->\r\n    <link href="bootstrap/css/sticky-footer.css" rel="stylesheet">\r\n  </head>\r\n\r\n  <body>\r\n    <!--Invoke the website header page-->\r\n    <?php require ''includes/header.php''; ?>\r\n    <!--Invoke the website footer page-->\r\n    <?php require ''includes/footer.php''; ?>\r\n    <!--Art Event page content-->\r\n    <div class="container">\r\n        <h3 class="text-info bg-info text-center"> <b>Check out our upcoming event schedule and meet your favorite artists! </b> </h3> <br>\r\n        <!--Event 1-->\r\n        <div class="media"> \r\n            <div class="media-body">\r\n            <h4 class="media-heading" style="color:darkblue"> <b> <u>Still Life : </b> <i> Exhibition and workshop by Raja Ravi Varma </u></i><small> (Followed by High Tea)</small></h4>\r\n            <p>Wednesday, February 24, 2016 <br>5:30 PM to 6:30 PM at San Diego Convention Center  </p>\r\n            <h5 class="text-warning"><strong>Time until the next big art event:</strong></h5>\r\n            <!--PHP code to display countdown to next event-->\r\n            <?php\r\n                    $phpCode=''\r\n                //Set Timezone to California\r\n                date_default_timezone_set(''America/Los_Angeles'');\r\n                //Capture current date and time\r\n                $today= new DateTime();\r\n                //Set event date and time    \r\n                $eventdate= new Datetime();\r\n                $eventdate->setDate(2016,2,24);\r\n                $eventdate->setTime(17,30);\r\n                //Calculate countdown\r\n                $countdown=date_diff($today,$eventdate);\r\n                //Display the countdown\r\n                if(!($today>$eventdate))\r\n                {\r\n                    if(($countdown->format(''%d'')!=0)&&($countdown->format(''%h'')!=0))\r\n                    {\r\n                        echo $countdown->format(''%d days, %h hours left !!'');\r\n                    }\r\n                    else if(($countdown->format(''%d'')==0)&&($countdown->format(''%h'')!=0))\r\n                    {\r\n                        echo $countdown->format(''Only %h hours %i minutes left !!'');\r\n                    }\r\n                    else if(($countdown->format(''%d'')!=0)&&($countdown->format(''%h'')==0))\r\n                    {\r\n                        echo $countdown->format(''%d days %i minutes left !!''); \r\n                    }\r\n                    else if(($countdown->format(''%d'')==0)&&($countdown->format(''%h'')==0)&&($countdown->format(''%i'')!=0))\r\n                    {\r\n                        echo "Hurry! Only ";\r\n                        echo $countdown->format(''%i minutes left !!'');\r\n                    }\r\n                }\r\n                else \r\n                {\r\n                    echo "You missed this event!";\r\n                }'';\r\n                eval($phpCode);\r\n            ?> \r\n            </div>\r\n            <div class="media-right">\r\n            <a href="#">\r\n            <img src="includes/Images/ArtEventImage1.jpg" alt="Raja Ravi Varma Painting" style="width: 130px" class="img-responsive; img pull-right"/>\r\n            </a>\r\n            </div>\r\n        </div> \r\n        <!--Event 2-->\r\n        <div class="media">\r\n            <div class="media-body">\r\n            <h4 class="media-heading" style="color:darkblue"> <b><u> Art in Full Color : </b> <i> A talk by Vincent Van Gogh</u> </i></h4> \r\n            <p> Monday, February 29, 2016 <br>5:00 PM to 6:00 PM at San Diego Art Center </p>\r\n            <h5 class="text-info"><strong>Time until the event:</strong></h5>\r\n            <!--PHP code to display countdown to next event-->\r\n            <?php\r\n                //Set Timezone to California\r\n                date_default_timezone_set(''America/Los_Angeles'');\r\n                //Capture current date and time\r\n                $today= new DateTime();\r\n                //Set event date and time    \r\n                $eventdate= new Datetime();\r\n                $eventdate->setDate(2016,2,29);\r\n                $eventdate->setTime(17,00);\r\n                //Calculate countdown to event\r\n                $countdown=date_diff($today,$eventdate);\r\n                //Display the countdown\r\n                if(!($today>$eventdate))\r\n                {\r\n                    if(($countdown->format(''%d'')!=0)&&($countdown->format(''%h'')!=0))\r\n                    {\r\n                        echo $countdown->format(''%d days, %h hours left !!'');\r\n                    }\r\n                    else if(($countdown->format(''%d'')==0)&&($countdown->format(''%h'')!=0))\r\n                    {\r\n                        echo $countdown->format(''Only %h hours %i minutes left !!'');\r\n                    }\r\n                    else if(($countdown->format(''%d'')!=0)&&($countdown->format(''%h'')==0))\r\n                    {\r\n                        echo $countdown->format(''%d days %i minutes left !!''); \r\n                    }\r\n                    else if(($countdown->format(''%d'')==0)&&($countdown->format(''%h'')==0)&&($countdown->format(''%i'')!=0))\r\n                    {\r\n                        echo "Hurry! Only ";\r\n                        echo $countdown->format(''%i minutes left !!'');\r\n                    }\r\n                }\r\n                else \r\n                {\r\n                    echo "You missed this event!";\r\n                }\r\n            ?> \r\n            </div>\r\n            <div class="media-right">\r\n            <a href="#">\r\n            <img src="includes/Images/ArtEventImage2.jpg" alt="Van Gogh Painting" style="width: 130px" class="img pull-right"/>\r\n            </a>\r\n            </div>\r\n        </div>\r\n    </div><!-- /.container --> \r\n    <!-- Bootstrap core JavaScript\r\n    ================================================== -->\r\n    <script src="bootstrap/js/jquery-1.12.0.min.js"></script>\r\n    <script>window.jQuery || document.write(''<script src="../../assets/js/vendor/jquery.min.js"><\\/script>'')</script>\r\n    <script src="bootstrap/js/bootstrap.min.js"></script>\r\n  </body>\r\n</html>\r\n\r\n\r\n', 'public');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pageid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `userid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `login` (`userid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
