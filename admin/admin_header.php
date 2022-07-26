<?php 
  $id = 100;
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
  <link href="../assets/img/favicon.png" rel="icon">
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
  <link rel="stylesheet" href="../leaflet/leaflet.css">
  <!-- map Js -->
  
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
          id: "<?php echo $id ?>"
        },
        type: "POST",
        url:"notification_clear.php",
        success:function(result){
          
        }
      })
    }

    const binStatus = setInterval(binCheck,1000);

    function binCheck(){
        $.ajax({
            data: {
                id: "<?php echo $id ?>",
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
          <li><a class="active " href="../logout.php">Log Out</a></li>
        </ul>
      </nav>

    </div>
  </header><!-- End Header -->
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
  <?php
    if($make_nav == 1){
      ?>
      <script> 
        $(document).ready(function(){
          $("#side_menu_1").addClass('admin_sidebar_nav_active');
        })
      </script>
      <?php
    }
    elseif($make_nav == 2){
      ?>
      <script> 
        $(document).ready(function(){
          $("#side_menu_2").addClass('admin_sidebar_nav_active');
        })
      </script>
      <?php
    }
    elseif($make_nav == 3){
      ?>
      <script> 
        $(document).ready(function(){
          $("#side_menu_3").addClass('admin_sidebar_nav_active');
        })
      </script>
      <?php
    }
    elseif($make_nav == 4){
      ?>
      <script> 
        $(document).ready(function(){
          $("#side_menu_4").addClass('admin_sidebar_nav_active');
        })
      </script>
      <?php
    }
    elseif($make_nav == 5){
      ?>
      <script> 
        $(document).ready(function(){
          $("#side_menu_5").addClass('admin_sidebar_nav_active');
        })
      </script>
      <?php
    }
    elseif($make_nav == 6){
      ?>
      <script> 
        $(document).ready(function(){
          $("#side_menu_6").addClass('admin_sidebar_nav_active');
        })
      </script>
      <?php
    }
    elseif($make_nav == 7){
      ?>
      <script> 
        $(document).ready(function(){
          $("#side_menu_7").addClass('admin_sidebar_nav_active');
        })
      </script>
      <?php
    }
  ?>

  <div class="d-flex flex-row">
    <div id="admin_sidebar">
        <ul class="admin_list_style">
          <a href="index.php"><li class="admin_sidebar_nav" id="side_menu_1">
            <div class="admin_sidebar_nav_items">
              <i class="ba bi-house-fill" style="margin-right: 10px;"></i> Dashboard
            </div>
          </li></a>
          <a href="admin_municipality.php"><li class="admin_sidebar_nav" id="side_menu_2">
            <div class="admin_sidebar_nav_items">
            <i class="ba bi-building" style="margin-right: 10px;"></i> WM office
            </div>
          </li></a>
          <a href="admin_truck.php"><li class="admin_sidebar_nav" id="side_menu_3">
            <div class="admin_sidebar_nav_items">
            <i class="ba bi-truck"style="margin-right: 10px;"></i> Trucks
            </div>
          </li></a>
          <a href="admin_driver.php"><li class="admin_sidebar_nav" id="side_menu_4">
            <div class="admin_sidebar_nav_items">
            <i class="ba bi-person-workspace" style="margin-right: 10px;"></i> Workers
            </div>
          </li></a>
          <a href="admin_bin.php"><li class="admin_sidebar_nav" id="side_menu_5">
            <div class="admin_sidebar_nav_items">
            <i class="ba bi-trash-fill" style="margin-right: 10px;"></i> Bins
            </div>
          </li></a>
          <a href="admin_user.php"><li class="admin_sidebar_nav"  id="side_menu_6">
            <div class="admin_sidebar_nav_items">
            <i class="ba bi-person-fill" style="margin-right: 10px;"></i> Users
            </div>
          </li></a>
          <a href="admin_route.php"><li class="admin_sidebar_nav" id="side_menu_7">
            <div class="admin_sidebar_nav_items">
            <i class="ba bi-pin-map-fill" style="margin-right: 10px;"></i> Route
            </div>
          </li></a>
        </ul>
    </div>
    <main id="admin_main">