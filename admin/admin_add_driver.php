<?php 
  $make_nav=4;
	include '../db/connection.php';
	include 'admin_header.php';
  include '../controls/admin_controls.php';
  	if(isset($_POST['submit'])){
    	$name = $_POST['name'];
    	$age = $_POST['age'];
    	$gender = $_POST['gender'];
    	$address = $_POST['address'];
    	$aadhaar = $_POST['aadhar'];
    	//$truck_no = $_POST['office'];
   		$phno = $_POST['phno'];
    	$gb_id = $_POST['wm'];
      $job = $_POST['job'];
    	$email = $_POST['email'];
    	$pass = $_POST['pass'];
    	$re_pass = $_POST['re_pass'];
    	$status = 1;
      if (empty($name)||empty($age)||empty($gender)||empty($address)||empty($aadhaar)||empty($phno)||empty($gb_id)||empty($job)||empty($email)||empty($pass)||empty($re_pass)){
        $status = 0;
        $err_alert = 1;
      }
      $sql_user = "Select username from tbl_login where username = '$email'";
      $res_user = mysqli_query($conn,$sql_user);
      if(mysqli_fetch_array($res_user)>0){
          $err_user = " Email already exists ";
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
    		//echo $name.$age.$gender.$address.$aadhaar.$exp.$phno.$email.$pass;
     		 $sql = "insert into tbl_driver(name,age,gender,address,aadhaar,type,gb_id,phno,username,password) values('$name','$age','$gender','$address','$aadhaar','$job','$gb_id','$phno','$email','$pass')";
     		 $res = mysqli_query($conn,$sql);
      		$sql3 = "SELECT id from tbl_driver ORDER BY id DESC LIMIT 1";
      		$res12 = mysqli_query($conn,$sql3);
      		$row = mysqli_fetch_array($res12);
     		  $user_id = $row['id'];
      		$sql4 = "insert into tbl_login(username,password,type,enter_id) values('$email','$pass','$job',$user_id)";
      		$result1 = mysqli_query($conn,$sql4);
      		if($res){
        		?>
        		<script type="text/javascript">
          		alert("Successfully Registered");
          		window.location.href="admin_driver.php";
       			 </script>
        		<?php
      		}
    	}
  	}
  	else{
   		$name=$age=$gender=$aadhaar=$address=$wm=$job=$phno=$email=$pass=$re_pass="";
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
  if(!isset($err_alert)){
    $err_alert = 0;
  }
?>

<script>
  $(document).ready(function(){
    $("#worker_basic").click(function(){
      $("#worker_basic").addClass("active");
      $("#worker_job").removeClass("active");
      $("#con_worker_basic").show();
      $("#con_worker_job").hide();
    });

    $("#worker_job").click(function(){
      $("#worker_job").addClass("active");
      $("#worker_basic").removeClass("active");
      $("#con_worker_job").show();
      $("#con_worker_basic").hide();
    });

    $("#worker_jobs").click(function(){
      $("#worker_job").addClass("active");
      $("#worker_basic").removeClass("active");
      $("#con_worker_job").show();
      $("#con_worker_basic").hide();
    });
  });

</script>


  <div class="container">
  <form method="post" action="">
    <div class="box">
      <div class="reg_txt_head">Add Driver Details</div>
      <ul class="nav nav-tabs">
        <li class="nav-item" style="width: 50%; cursor:pointer;">
          <div class="nav-link active" id="worker_basic">Basic Details</div>
        </li>
        <li class="nav-item" style="width: 50%;  cursor:pointer;">
          <div class="nav-link" id="worker_job">Job Details</div>
        </li>
      </ul>
      <div class="row" id="con_worker_basic">
          <div class="admin_reg_worker">
          <table>
            <tbody>
            <?php
          if($err_alert==1){
            ?>
            <tr><td colspan=2>
            <div class="alert alert-danger text-center" role="alert">
                Please fill up all the details
            </div></td>
            </tr>
            <?php
          } 
          ?>
              <tr>
                <td class="text-left">Name</td>
                <td><input class="admin_reg_work_inp" type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"></td>
              </tr>
              <tr>
                <td class="text-left">Gender</td>
                <td ><input style="margin-right: 10px;" type="radio" name="gender" value="Male" <?php echo (strcmp("$gender","Male")) ? : "checked" ?> >Male<br>
                    <input style="margin-right: 10px;" type="radio" name="gender" value="Female" <?php echo (strcmp("$gender","Female")) ? : "checked" ?>>Female</td>
              </tr>
              <tr>
                <td class="text-left">Age</td>
                <td><input class="admin_reg_work_inp" type="text" name="age" value="<?php echo htmlspecialchars($age); ?>" ></td>
              </tr>
              <tr>
                <td class="text-left">Aadhaar Number</td>
                <td><input class="admin_reg_work_inp" type="text" name="aadhar" value="<?php echo htmlspecialchars($aadhaar); ?>" ></td>
              </tr>
              <tr>
                <td class="text-left">Phone Number</td>
                <td><input class="admin_reg_work_inp" type="text" name="phno" value="<?php echo htmlspecialchars($phno); ?>" ><div class="admin_txt_red"><?php echo $err_phno; ?></div></td>
              </tr>
              <tr>
                <td class="text-left">Address</td>
                <td><textarea class="admin_reg_work_inp" rows="3" cols="22" name="address" ><?php echo htmlspecialchars($address); ?></textarea></td>
              </tr>
              <tr>
                <td class="text-left">Email</td>
                <td ><input class="admin_reg_work_inp" type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><div class="admin_txt_red"><?php echo $err_user; ?></div></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="register_btn"><button type="button" class="reg_btn" id="worker_jobs">Next</button></div>
      </div>

      <div class="row" id="con_worker_job">
        <div class="admin_reg_worker">
          <table>
            <tbody>
              <tr>
                <td class="text-left">WM Office</td>
                <?php
                  $result2 = fetch_all_gb($conn);
                ?>
                <td><select name="wm" class="admin_reg_work_inp">
                    <option></option>
                    <?php
                      while($row2 = mysqli_fetch_array($result2)){
                        ?>
                        <option value="<?php echo $row2['gb_id']; ?>"><?php echo $row2['gb_name']; ?></option>
                        <?php
                      } 
                    ?>
                </select></td>
              </tr>
              <tr>
                <td class="text-left">Job Type</td>
                <td><select class="admin_reg_work_inp" name="job">
                    <option ></option>
                    <option value=1> Walking Garbage Collector</option>
                    <option value=2> Driver </option>
                </select></td>
              </tr>
              <tr>
                <td class="text-left">Set Password</td>
                <td ><input class="admin_reg_work_inp" type="password" name="pass" value="<?php echo htmlspecialchars($pass); ?>"></td>
              </tr>
              <tr>
                <td class="text-left">Confirm Password</td>
                <td ><input class="admin_reg_work_inp" type="password" name="re_pass" value="<?php echo htmlspecialchars($re_pass); ?>"><div class="admin_txt_red"><?php echo $err_pass; ?></div></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="register_btn"><button type="submit" class="reg_btn" name="submit">Register</button></div>
      </div>
    </div>
  </form>
  </div>
<?php include 'admin_footer.php'; ?>