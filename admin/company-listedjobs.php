<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['crmsaid']==0)) {
  header('location:logout.php');
  } else{

//Code For Deletion
if($_GET['action']=='delete'){
$vid=intval($_GET['vid']);
$query=mysqli_query($con,"delete from tblvacancy where ID='$vid'");
if($query){
echo "<script>alert('Vacany record deleted successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-vacancy.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}

}

  ?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    
    <title>Campus Recruitment Management System-Listed Vacancy</title>
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
                         Vacancies/Jobs Listed By <?php echo $_GET['compname'];?>
                    </h3>
                </div>
            </div>
        </div>
    </header><br />
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
                               $cid=$_GET['compid'];
$ret=mysqli_query($con,"select *from  tblvacancy where CompanyID='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                           <tr>
                  <td><?php echo $cnt;?></td>
            
                  <td><?php  echo $row['JobTitle'];?></td>
                  <td><?php  echo $row['JobpostingDate'];?></td>
                  <td><a href="edit-vacancy.php?editid=<?php echo $row['ID'];?>" class="btn btn-primary" target="_blank">Edit</a>
    <a href="manage-vacancy.php?action=delete&&vid=<?php echo $row['ID']; ?>" class="btn btn-danger" title="Delete this record" onclick="return confirm('Do you really want to delete this record?');">Delete </a>
                  </td>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
                          
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