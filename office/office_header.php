<?php
include "../db/connection.php";
include '../controls/admin_controls.php';
if(!isset($_SESSION['off_id'])){
  header("location:../office_login.php");
}
$gb_id = $_SESSION['off_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Garbage Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/lg_2.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">
  <script src="../assets/js/jquery-3.6.0.js"></script>
  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/layout.css">
  <link rel="stylesheet" href="../leaflet/leaflet.css" />

  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" /> 
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="../leaflet/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
  <!-- =======================================================
  * Template Name: Moderna - v4.8.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <script>
    $(document).ready(function(){
      $('#clear_all_btn').click(function(){
        clear_notification();
      })
    });

    function clear_notification(){
      $.ajax({
        data: {
          gb_id: "<?php echo $gb_id ?>"
        },
        type: "POST",
        url:"clear_notifications.php",
        success:function(result){
          
        }
      })
    }

    const binStatus = setInterval(binCheck,1000);

    function binCheck(){
        $.ajax({
            data: {
                gb_id: "<?php echo $gb_id ?>",
            },
            type: 'POST',
            url:"notification.php",
            success: function(result){
               var not_value = $(result).find('#not_try').text();
               if (not_value!=0){
                 document.getElementById('notification_number').style.display="block";
                 document.getElementById('notification_number').innerHTML = $(result).find('#not_try').html();
               }
               else{
                document.getElementById('notification_number').style.display="none";
               }
               document.getElementById('notify').innerHTML = $(result).find('#not_body').html();
            }
        })
    }
  </script>

  <!-- ======= Header ======= -->
  <header id="header_admin" class="fixed-top d-flex align-items-center transparent header-scrolled">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.html"><span><img src="../assets/img/lg_1.png"></span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>
      <nav id="navbar" class="navbar">
        <ul>
          <li>
            <button class="off_notbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <i class="ba bi-bell-fill"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id = "notification_number" style="display: none;">
                
              </span>
            </button>
          </li>
          <li class="dropdown">
            <a href="#"><i class="bi bi-wrench"></i></a>
            <ul>
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </li>
          </ul>
          </nav>
    </div>
  </header>

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header border">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" style="margin-right: 10px;"></button>
              Notifications
            </h5>
            <button class="btn btn-outline-dark" data-bs-dismiss="offcanvas" aria-label="Close" id="clear_all_btn">Clear All</button>
            
          </div>
          <div class="offcanvas-body p-0" id="notify">
            
          </div>
        </div>

      <!-- <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active " href="index.php">Home</a></li>
          <li class="dropdown">
            <a href="#"><span>Bins</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="add_bin.php">Add Bin</a></li>
              <li><a href="view_bin.php">View Bins</a></li>
            </ul>
          </li>
          <li><a href="office_user.php"><span>User</span></a></li>
          <li><a href="complaints.php"><span>Complaints</span></a></li>
          <li><a href="route_home.php"><span>Route</span></a></li>
          <li class="dropdown">
            <a href="#"><i class="bi bi-wrench"></i></a>
            <ul>
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>.navbar -->
<!-- End Header -->
<div class="d-flex flex-row">
    <div id="admin_sidebar">
        <ul class="admin_list_style">
          <a href="index.php"><li class="admin_sidebar_nav" id="side_menu_1" style="margin-top: -10px;">
            <div class="admin_sidebar_nav_items">
              <i class="ba bi-house-fill" style="margin-right: 10px;"></i> Dashboard
            </div>
          </li></a>
          <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><li class="admin_sidebar_nav" id="side_menu_2">
            <div class="admin_sidebar_nav_items">
            <i class="ba bi-trash-fill" style="margin-right: 10px;"></i> Bins
            </div>
          </li></a>
          <div class="collapse" id="collapseExample">
            <div class="card card-body p-0">
              <a href="add_bin.php"><button class="office_sub_nav">Add Bin</button></a>
              <a href="view_bin.php"><button class="office_sub_nav">View Bin</button></a>
              <a href="request_bin.php"><button class="office_sub_nav">Request Bin</button></a>
            </div>
          </div>
          <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
          <li class="admin_sidebar_nav" id="side_menu_2">
            <div class="admin_sidebar_nav_items">
            <i class="ba bi-pin-map-fill" style="margin-right: 10px;"></i> Route
            </div>
          </li></a>
          <div class="collapse" id="collapseExample2">
            <div class="card card-body p-0">
              <a href="route_home.php"><button class="office_sub_nav">Route</button></a>
              <a href="route.php"><button class="office_sub_nav">Add Route</button></a>
              <a href="route_edit.php"><button class="office_sub_nav">Edit Route</button></a>
              <a href="route_assign_truck.php"><button class="office_sub_nav">Assign Truck</button></a>
            </div>
          </div>
          <a data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample">
          <li class="admin_sidebar_nav" id="side_menu_2">
            <div class="admin_sidebar_nav_items">
            <i class="ba bi-person-workspace" style="margin-right: 10px;"></i> Workers
            </div>
          </li></a>
          <div class="collapse" id="collapseExample3">
            <div class="card card-body p-0">
              <a href="worker.php"><button class="office_sub_nav">View Workers</button></a>
              <a href="worker_assign_bin.php"><button class="office_sub_nav">Assign Bins</button></a>
            </div>
          </div>
          <a href="office_user.php"><li class="admin_sidebar_nav" id="side_menu_4">
            <div class="admin_sidebar_nav_items">
            <i class="ba bi-person-fill" style="margin-right: 10px;"></i> Users
            </div>
          </li></a>
          <a href="complaints.php"><li class="admin_sidebar_nav"  id="side_menu_6">
            <div class="admin_sidebar_nav_items">
            <i class="ba bi-person-fill" style="margin-right: 10px;"></i> Complaints
            </div>
          </li></a>
        </ul>
    </div>
    <main id="admin_main">