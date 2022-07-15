<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Garbage Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
  <link rel="stylesheet" type="text/css" href="assets/css/layout.css">
  
  <!-- =======================================================
  * Template Name: Moderna - v4.8.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<?php
	if(!isset($err)){
		$err="";
	}
?>
<body>


    <section class="login_form_off">
    	<form method="post" action="login_action.php">
      <input type="text" name="page" value=3 hidden>
    		<div class="box">
    			<div class="col">
    				<div class="bg0">
    					<div class="txt_head">Office Login</div>
              <?php 
                  if(!empty($err)){
                    ?>
                      <div class="alert alert-danger m-auto w-50"> <?php echo $err ?></div>
                    <?php
                  }
                  ?>
    					<div class="txt_input1">
    					   <input class="input1" type="text" name="username" placeholder="Username" autocomplete="off" required><br>
							   <input class="input1" type="Password" name="password" placeholder="Password" required>
						  </div>
              <br>
						  <!-- <div class="error"><?php // echo $err; ?></div> -->
              <div class="txt_input1">
                <button class="login_btn" type="submit" name="submit">Login</button>
              </div>
            </div>
    			</div>
    		</div>
    	</form>
    </section>
    

