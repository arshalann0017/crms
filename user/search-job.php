<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['crmsuid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    
    <title>Campus Recruitment Management System-Search Job</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>
</head>
<body class="light">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
        </div>
    </div>
</div>
<div id="app">
<?php include_once('includes/sidebar.php');?>
<!--Sidebar End-->
<?php include_once('includes/header.php');?>
<div class="page has-sidebar-left bg-light height-full">


    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-md-12">
              
                <div class="card my-3 no-b">
                    <div class="card-body">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row">
                <div class="col">
                    <h3 class="my-3">
                       Search Job
                    </h3>
                </div>
            </div>
        </div>
    </header>

                        <form method="post">
                                
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4" class="col-form-label"> Search Job by Title</label>
                                        <input type="text" class="form-control" id="searchdata" name="searchdata" required="true" 
                                               placeholder="Job Title">
                                    </div>
                                   
                                </div>
                               
                                <button type="submit" class="btn btn-primary" name="search">Search</button>
                            </form>
                        <hr />
                        <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  <h4 align="center">Result against "<?php echo $sdata;?>" keyword </h4> 
                        <table class="table table-bordered table-hover data-tables"
                               data-options='{ "paging": false; "searching":false}'>
                            <thead>
                             <tr>
                  <th>S.NO</th>
            
                  <th>Job Title</th>
                    <th>Job Posting Date</th>       
                   <th>Action</th>
                </tr>
                            </thead>
                            <tbody>
                                <?php
                              
$ret=mysqli_query($con,"select *from  tblvacancy where JobTitle like '%$sdata%'");
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                           <tr>
                  <td><?php echo $cnt;?></td>
            
                  <td><?php  echo $row['JobTitle'];?></td>
                  <td><?php  echo $row['JobpostingDate'];?></td>
                  <td><a href="view-vacancy-details.php?viewid=<?php echo $row['ID'];?>" class="btn btn-primary">Apply For Job</a></td>
                </tr>
                <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> No record found against this search</td>

  </tr>
   
<?php }} ?>
                          
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<!--/#app -->
<script src="assets/js/app.js"></script>
</body>
</html>
<?php }  ?>