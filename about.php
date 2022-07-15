<?php
  include 'db/connection.php';
  $sql = "Select * from tbl_gb";
  $res = mysqli_query($conn,$sql);
  $count = mysqli_num_rows($res);
  $sql1 = "Select * from tbl_user";
  $res1 = mysqli_query($conn,$sql1);
  $count1 = mysqli_num_rows($res1);
  $sql2 = "Select * from tbl_bins";
  $res2 = mysqli_query($conn,$sql2);
  $count2 = mysqli_num_rows($res2);
  $sql3 = "Select * from tbl_truck";
  $res3 = mysqli_query($conn,$sql3);
  $count3 = mysqli_num_rows($res3);
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
  <link href="assets/img/lg_2.png" rel="icon">
  <link href="assets/img/lg_2.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Moderna - v4.8.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.html"><span><img src="assets/img/lg_1.png"></span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active " href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <!-- <li><a href="#">Locate Trash Bin</a></li> -->
          <li class="dropdown"><a href="#"><span>Login</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="user_login.php">User Login</a></li>
              <li><a href="driver_login.php">Driver Login</a></li>
              <li><a href="office_login.php">Office Login</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
   <main id="main">

    <!-- ======= About Us Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>About Us</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>About Us</li>
          </ol>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <section class="about" data-aos="fade-up">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <h3>Punalur Municipality Waste Management Office.</h3>
            <p class="fst-italic">
              The waste management system is primarly developed for the punalur thaluk. The Punalur WM office is the headquarter of this system.
            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> It manages all the garbage collection data in the punalur thaluk.</li>
              <li><i class="bi bi-check2-circle"></i> Actually the garbage collection is performed by the local panchayat bodies.</li>
              <li><i class="bi bi-check2-circle"></i>Punalur WM provides trucks to each panchayat that registered with the system. It collects the garbage and weekly it is transported to the waste management plants</li>
              <li><i class="bi bi-check2-circle"></i>Punalur WM also provides a interface to the users, inorder for the participation and collaboration of citizens to the system</li>
            </ul>
          </div>
        </div>

      </div>
    </section>

     <section class="facts section-bg" data-aos="fade-up">
      <div class="container">

        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $count1 ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Users</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $count ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Offices</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $count2 ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Bins</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $count3 ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Trucks</p>
          </div>

        </div>

      </div>
    </section><!-- End Facts Section -->


     </main><!-- End #main -->
 <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">



    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="about.php">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="locate.php">Locate</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="user_login.php">Login</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> Facility Management</li>
              <li><i class="bx bx-chevron-right"></i> Smart Bin Detection</li>
              <li><i class="bx bx-chevron-right"></i> Garbage Collecion</li>
              <li><i class="bx bx-chevron-right"></i> User Management</li>
              <li><i class="bx bx-chevron-right"></i> Truck Management</li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              Garbage Head Office<br>
              Opposite Chemmathoor Ground<br>
              Punalur <br><br>
              <strong>Phone:</strong> +91 9845621348<br>
              <strong>Email:</strong> gb@management.com<br>
            </p>

          </div>

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>About</h3>
            <p>Website provides an efficient and new hand technology for managing the exisiting facilities in order to work properly.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Moderna</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <span class="txt">Shiyas Shajahan</span>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>