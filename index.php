<?php
session_start();

// Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure DB connection is working
if (file_exists('includes/dbconnection.php')) {
    include('includes/dbconnection.php');
} else {
    die("Error: dbconnection.php not found.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Campus Recruitment Management System | Home Page</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- CSS Files -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/zoomslider.css" rel="stylesheet" />
    <link href="css/style6.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/fontawesome-all.css" rel="stylesheet" />
    <link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
</head>

<body>
    <!-- Header / Banner -->
    <div id="demo-1" data-zs-src='["images/1.jpg", "images/2.jpg", "images/3.jpg", "images/4.jpg"]' data-zs-overlay="dots">
        <div class="demo-inner-content">
            <div class="header-top">
                <?php include_once('includes/header.php'); ?>
            </div>
        </div>
    </div>

    <!-- Job Listings -->
    <section class="banner-bottom-wthree pb-lg-5 pb-md-4 pb-3">
        <div class="container">
            <div class="inner-sec-w3ls py-lg-5 py-3">
                <h3 class="tittle text-center mb-lg-4 mb-3">
                    <span>Some Info</span> Latest Job Flow Positions
                </h3>

                <div class="tabs mt-5">
                    <ul class="nav nav-pills my-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">Recent Jobs</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                            <div class="menu-grids mt-4">
                                <div class="row t-in">
                                    <div class="col-lg-8 text-info-sec">
                                        <?php
                                        $ret = mysqli_query($con, "
                                            SELECT tblcompany.ID as cid, tblcompany.CompanyName, tblvacancy.ID,
                                            tblvacancy.JobTitle, tblvacancy.NoofOpenings, tblvacancy.MonthlySalary,
                                            tblvacancy.JobLocation, tblvacancy.LastDate 
                                            FROM tblcompany 
                                            JOIN tblvacancy ON tblcompany.ID = tblvacancy.CompanyID 
                                            ORDER BY rand() LIMIT 6");

                                        while ($row = mysqli_fetch_array($ret)) {
                                        ?>
                                            <div class="job-post-main row">
                                                <div class="col-md-9 job-post-info text-left">
                                                    <div class="job-post-icon"><i class="fas fa-briefcase"></i></div>
                                                    <div class="job-single-sec">
                                                        <h4><?= $row['JobTitle']; ?></h4>
                                                        <p class="my-2"><?= $row['CompanyName']; ?></p>
                                                        <ul class="job-list-info d-flex">
                                                            <li><i class="fas fa-users"></i> <?= $row['NoofOpenings']; ?></li>
                                                            <li><i class="fas fa-dollar-sign"></i> <?= $row['MonthlySalary']; ?>/Month</li>
                                                            <li><i class="fas fa-map-marker-alt"></i> <?= $row['JobLocation']; ?></li>
                                                            <li><i class="fas fa-calendar"></i> <?= $row['LastDate']; ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 job-single-time text-right">
                                                    <a href="single-job-details.php?viewid=<?= $row['ID']; ?>" class="aply-btn">Details</a>
                                                </div>
                                            </div><br />
                                        <?php } ?>
                                        <a href="jobs-listed.php" class="aply-btn">More..</a>
                                    </div>

                                    <div class="col-lg-4 text-info-sec">
                                        <img src="images/job-1.jpg" alt="Job Image" class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Resume CTA -->
    <section class="banner-bottom-wthree mid py-lg-5 py-3">
        <div class="container">
            <div class="inner-sec-w3ls py-lg-5 py-3">
                <div class="mid-info text-center pt-3">
                    <h3 class="tittle text-center mb-lg-5 mb-3">
                        <span>Some Info</span> Make a Difference with Your Online Resume!
                    </h3>
                    <div class="resume">
                        <a href="user/user-signup.php"><i class="far fa-user"></i> Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include_once('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.zoomslider.min.js"></script>
    <script src="js/classie-search.js"></script>
    <script src="js/demo1-search.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.countup.js"></script>
    <script>$('.counter').countUp();</script>
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({ scrollTop: $(this.hash).offset().top }, 900);
            });

            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>
</body>
</html>
