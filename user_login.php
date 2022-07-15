<!DOCTYPE html>
<html lang="en" style="height: 100%;">

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
<body class="h-100 w-100">

  <div class="container login_form h-100">
    <div class="row h-100 justify-content-center align-content-center">
      <div class="col-sm-5 border shadow login_form_col">
          <div class="row h-100 justify-content-center align-content-center text-center">
            <div class="col">
              <div class="txt_head">
                Login Page
              </div>
              <form method="post" action="login_action.php">
                <input type="text" name="page" value="1" hidden>
                <div class="login_input_group ">
                  <?php 
                  if(!empty($err)){
                    ?>
                      <div class="alert alert-danger login_input1"> <?php echo $err ?></div>
                    <?php
                  }
                  ?>
                  <input type="text" name="username" placeholder="Username" class="login_input1 form-control border">
                  <input type="password" name="password" placeholder="Password" class="login_input1 form-control border">
                </div>
                <button type="submit" name="submit" class="btn btn-success login_input_btn"> Login </button>
              </form>
              <div class="line_with_text">
                <div class="line_with_round">or</div>
              </div>
              <div class="login_input_signup">
                Create an Account <a href="register.php">Register Now</a>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

    <!-- <div class="container login_form">
    	<form method="post" action="login_action.php">
        <div class="row">
    			<div class="col">
    				<div class="bg0">
    					<div class="txt_head">User Login</div>
    					<div class="txt_input1">
    					   <input class="input1" type="text" name="username" placeholder="Username" required><br>
							   <input class="input1" type="Password" name="password" placeholder="Password" required>
						  </div>
						  <div class="error"><?php echo $err; ?></div>
              <div class="txt_input1">
                <button class="login_btn" type="submit" name="submit">Login</button>
              </div>
              <br>
              <div class="line_with_text">
                <div class="line_with_round">or</div>
              </div>
              <div class="txt_input1">
                Create an Account
              </div>
              <div class="txt_input1">
                <a href="register.php"><button class="login_btn2" type="button">Sign Up</button></a>
              </div>
            </div>
    			</div>
        </div>
    	</form>
    </div> -->
    

</body>
</html>