<?php
  include 'db/connection.php';
  include 'controls/admin_controls.php';
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $aadhaar = $_POST['aadhar'];
    $off = $_POST['office'];
    $phno = $_POST['phno'];
    $pin = $_POST['pin'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $re_pass = $_POST['repass'];

    // Reading file values
    $pic_name = $_FILES['profile']['name'];
    $tmp = $_FILES['profile']['tmp_name'];
    $photo = "uploads/".$pic_name;
    $destination = "assets/".$photo;

    $check = getimagesize($tmp);
    if($check === false) {
      $status = 0;
      $err_pic = "Invalid Image";
    }

    $status = 1;
    $res_user = check_username($conn,$email);
    if(mysqli_fetch_array($res_user)>0){
        $err_user = " Email already exists ";
        $status = 0;
    }
    if(strlen($pin)!=6){
      $err_pin = " * Invalid pin ";
      $status = 0;
    }
    if(strlen($phno)!=10){
      $err_phno=" * Invalid Phone Number";
      $status=0;
    }
    if(strlen($pass)<8){
      $err_pass=" * Password Too Short";
      $status = 0;
    }
    elseif($pass != $re_pass){
      $err_pass = " * Password not match";
      $status = 0;
    }
    if ($status==1){
      $res = insert_user($conn,$name,$age,$gender,$address,$aadhaar,$pin,$phno,$photo,$off,$email,$pass);
      $result_move = move_uploaded_file($tmp,$destination);
      $res12 = fetch_last_user($conn);
      $row = mysqli_fetch_array($res12);
      $user_id = $row['u_id'];
      $type = 4;
      $result1 = insert_to_login($conn,$email,$pass,$type,$user_id);
      if($res and $result_move and $result1){
        ?>
        <script type="text/javascript">
          alert("Successfully Registered");
          window.location.href="user_login.php";
        </script>
        <?php
      }
    }
  }
  else{
    $name=$age=$gender=$aadhaar=$address=$pin=$off=$phno=$email=$pass=$repass="";
  }
  if(!isset($err_pin)){
    $err_pin = "";
  }
  if(!isset($err_phno)){
    $err_phno = "";
  }
  if(!isset($err_pass)){
    $err_pass = "";
  }
  if(!isset($err_user)){
      $err_user = "";
  }
  if(!isset($err_pic)){
    $err_pic = "";
}

?>
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
  <script src="assets/js/jquery-3.6.0.js"></script>

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
<body class="h-100">
  <script>
    $(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $('.reg_img').attr('src', e.target.result);
              $('#profile_pic').attr('value',e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#profile_pic").on('change', function(){
        readURL(this);
    });

    $("#upload-button").click(function() {
      $("#profile_pic").click();
    });
});
</script>
<div class="container-mg h-100 overflow-auto" style="background-color: #e3e1de;">
  <div class="row mx-0">
    <div class="reg_txt_head">Registration Form</div>
  </div>
  <form method="post" action="" enctype="multipart/form-data">
  <div class="row mx-0">
    <div class="text-center w-100">
      <img class="reg_img" id="upload-button" src="assets/img/person_icon.png">
        <i class="ba bi-camera-fill reg_file_upload"></i> 
        <input type='file' name='profile' id="profile_pic" style="display: none;">
        <div class="admin_txt_red"><?php echo $err_pic; ?></div>
    </div>
  </div>
  
  <div class="row reg_form">
    <div class="col-sm-6 text-center">
      <table class="reg_table">
        <tbody class="text-center">
          <tr>
                <td>Name</td>
                <td><input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required></td>
              </tr>
              <tr>
                <td>Gender</td>
                <td style="text-align: center;" >
                  <input type="radio" name="gender" value="Male" style="margin-right: 5px;" required>Male
                  <input type="radio" name="gender" value="Female" style="margin: 0px 5px 0px 10px" required>Female</td>
              </tr>
              <tr>
                <td >Address</td>
                <td><textarea rows="3" cols="22" name="address" class="form-control" required><?php echo htmlspecialchars($address); ?></textarea></td>
              </tr>
              <tr>
                <td>Place</td>
                <td>
                  <select name="office" class="form-control"> 
                    <?php 
                    $sql2 = "SELECT gb_id,gb_name from tbl_gb";
                    $result2 = mysqli_query($conn,$sql2); 
                    while ($row2 = mysqli_fetch_array($result2)) {
                      ?>
                  <option value="<?php echo $row2['gb_id'];?>"><?php echo $row2['gb_name']; ?></option>
                  <?php
                }
                ?> 
                    </select>
                </td>
              </tr>
              <tr>
                <td>Email</td>
                <td><input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="form-control" required><div class="admin_txt_red"><?php echo $err_user; ?></td>
              </tr>
              </tbody>
            </table>
          </div>
          <div class="col-sm-6">
          <table class="reg_table2">
            <tbody class="text-center">
              <tr>
                <td class="td_mob">Age</td>
                <td><input type="number" name="age" value="<?php echo htmlspecialchars($age); ?>" class="form-control" required></td>
              </tr>
              <tr>
                <td class="td_mob">Aadhaar Number</td>
                <td><input type="number" name="aadhar" value="<?php echo htmlspecialchars($aadhaar); ?>" class="form-control" required></td>
              </tr>
              <tr>
                <td class="td_mob">Phone Number</td>
                <td><input type="number" name="phno" value="<?php echo htmlspecialchars($phno); ?>" class="form-control" required><div class="admin_txt_red"><?php echo $err_phno; ?></div></td>
              </tr>
              <tr>
                <td class="td_mob">pin</td>
                <td><input type="number" name="pin" value="<?php echo htmlspecialchars($pin); ?>" class="form-control" required><div class="admin_txt_red"><?php echo $err_pin; ?></div></td>
              </tr>
              <tr>
                <td class="td_mob">Password</td>
                <td><input type="Password" name="pass" value="<?php echo htmlspecialchars($pass); ?>" class="form-control" required></td>
              </tr>
              <tr>
                <td class="td_mob">Confirm Password</td>
                <td><input type="Password" name="repass" class="form-control" required><div class="admin_txt_red"><?php echo $err_pass; ?></div></td>
              </tr>
            </tbody>
            </table>
          </div>
        </div>
      <div class="register_btn"><button type="submit" class="reg_save_btn" name="submit">Register</button></div>
      </div>
    </div>
  </form>
</section>
</div>

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
  <script type="text/javascript" src="assets/js/mystyle.js"></script>


</body>

</html>