<?php
	include 'user_header.php';
	if(!isset($err_pic)){
		$err_pic = "";
	}
		$dr_id = $_SESSION['user_id'];
		if(!isset($error_pass)){
			$error_pass="";
		}
		if (isset($_POST['p_submit'])){
			$name = $_POST['name'];
			$age = $_POST['age'];
			$gender = $_POST['gender'];
			$exp = $_POST['exp'];
			$username = $_POST['user'];
			$aadhaar = $_POST['adhar'];
			$phno = $_POST['phno'];
			$address = $_POST['address'];

			$status = 1;
			// Reading file values
			$pic_name = $_FILES['profile']['name'];
			$tmp = $_FILES['profile']['tmp_name'];
			$photo = "uploads/".$pic_name;
			$destination = "../assets/".$photo;
			
			$check = getimagesize($tmp);
			if($check === false) {
			$status = 0;
			$err_pic = "Invalid Image";
			}
			if($status == 1){
				$result_move = move_uploaded_file($tmp,$destination);
				$sql1 = "update tbl_user set name='$name',age='$age',gender='$gender',pin='$exp',email='$username',aadhaar='$aadhaar',phno='$phno',address='$address',photo='$photo' where u_id='$dr_id'";
				$result = mysqli_query($conn,$sql1);
				if($result){
					$sql2 = "update tbl_login set username='$username' where type=1 and enter_id='$dr_id'";
					$result2=mysqli_query($conn,$sql2);
					?>
				<script type="text/javascript">
					alert("Data Updated");
					</script>
				<?php
			}
			}
		}


		if(isset($_POST['pass_submit'])){
			$cur_pass = $_POST['cur_pass'];
			$new_pass = $_POST['new_pass'];
			$re_pass = $_POST['re_pass'];
			$sql4 = "Select password from tbl_user where u_id='$dr_id'";
			$res4 = mysqli_query($conn,$sql4);
			$row=mysqli_fetch_array($res4);
			$pass = $row['password'];
			if ($pass != $cur_pass){
				$error_pass = " Current Password doesn't match";
			}
			elseif($new_pass != $re_pass){
				$error_pass = " Password and Confirm password do not match ";
			}
			else{
				$sql_ins = "update tbl_user set password='$new_pass' where u_id = '$dr_id'";
				$res_ins = mysqli_query($conn,$sql_ins);
				if($res_ins){
					$sql_lo = "update tbl_login set password='$new_pass' where type=1 and enter_id = '$dr_id'";
					$res_lo = mysqli_query($conn,$sql_lo);
					if($res_lo){
						?>
						<script type="text/javascript">
							alert("Password changed successfully");
						</script>
						<?php
					}
				}
			}
		}
?>
<script>
	$(document).ready(function(){
		$('#first_link').click(function(){
			$('#personal_details_content').show();
			$('#password_change_content').hide();
			$('#first_content_link').addClass("active");
			$('#second_content_link').removeClass("active");
		})

		$('#second_link').click(function(){
			$('#password_change_content').show();
			$('#personal_details_content').hide();
			$('#second_content_link').addClass("active");
			$('#first_content_link').removeClass("active");
		})

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
<section class="breadcrumbs p-0">
    <div class="container">
		<ul class="nav nav-tabs">
			<li class="nav-item" id="first_link">
				<div class="nav-link active" id="first_content_link">Personal Details</div>
			</li>
			<li class="nav-item" id="second_link" >
				<div class="nav-link" id="second_content_link">Change Password</div>
			</li>
		</ul>
 	</div>
</section>
	<div class="container mt-5">
		<div class="row" id="personal_details_content">
			<div class="col-md-12 shadow p-3 mb-5 rounded">
  				<div class="col-md-12 driver_align_right">
  					<button class="admin_edit_btn2" id="admin_edit_editbtn"><i class="bi-pencil-square"></i>&nbsp;edit</button>
  				</div>
  				<form id="myform" method="post" action="" enctype="multipart/form-data">
				<?php 
	  					$sql = "Select * from tbl_user where u_id='$dr_id'";
	  					$res = mysqli_query($conn,$sql);
	  					$row = mysqli_fetch_array($res);
	  			?>
				<div class="row mx-0">
					<div class="text-center w-100">
					<img class="reg_img" id="upload-button" src="<?php echo "../assets/".$row['photo'] ?>" >
						<i class="ba bi-camera-fill reg_file_upload"></i> 
						<input type='file' name='profile' id="profile_pic" style="display: none;">
						<div class="admin_txt_red"><?php echo $err_pic; ?></div>
					</div>
				</div>
  				<div class="row">
	  				<div class="col-md-6">
	  					<div class="driver_table">
	  						<?php 
	  							$sql = "Select * from tbl_user where u_id='$dr_id'";
	  							$res = mysqli_query($conn,$sql);
	  							$row = mysqli_fetch_array($res);
	  						?>
		  					<table>
		  						<tr>
		  							<td> Name </td>
		  							<td> <input type="text" name="name" class="form-control" style="margin-bottom: 0px;" value="<?php echo $row['name'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Gender </td>
		  							<td> <input type="text" name="gender" class="form-control" style="margin-bottom: 0px;"  value="<?php echo $row['gender'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> PIN </td>
		  							<td> <input type="text" name="exp" class="form-control" style="margin-bottom: 0px;" value="<?php echo $row['pin'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Email </td>
		  							<td><input type="email" name="user" class="form-control" style="margin-bottom: 0px;" value="<?php echo $row['email'] ?>" disabled></td>
		  						</tr>
		  					</table>
		  				</div>
	  				</div>
	  				<div class="col-md-5">
	  					<div class="driver_table">
	  						<?php 
	  							$sql = "Select * from tbl_user where u_id='$dr_id'";
	  							$res = mysqli_query($conn,$sql);
	  							$row = mysqli_fetch_array($res);
	  						?>
		  					<table>
		  						<tr>
		  							<td> Age </td>
		  							<td> <input type="text" name="age" class="form-control user_table_td" style="margin-bottom: 0px;" value="<?php echo $row['age'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Aadhaar </td>
		  							<td> <input type="text" name="adhar" class="form-control" style="margin-bottom: 0px;" value="<?php echo $row['aadhaar'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Phone </td>
		  							<td><input type="text" name="phno" class="form-control" style="margin-bottom: 0px;" value="<?php echo $row['phno'] ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Address</td>
		  							<td><textarea name="address" rows="2" cols="23" class="form-control" style="margin-bottom: 0px;" disabled><?php echo $row['address'] ?></textarea></td>
		  						</tr>
		  					</table>
		  				</div>
	  				</div>
	  				<div class="col text-center m-3">
	  					<button type="submit" name="p_submit" class="reg_save_btn" disabled>Save Changes</button>
	  				</div>
  				</div>
  				</form>
  			</div>
  		</div>
  		<div class="row justify-content-center w-100" style="display: none;" id="password_change_content">
  			<form method="post" action="profile.php#password_change" id="password_change">
			<div class="col-sm-6 shadow p-3 m-auto mb-5 rounded">
  					<div class="driver_table" style="margin-bottom:20px;">
  					<table>
  						<tr>
  							<td>Current Password</td>
  							<td><input type="password" name="cur_pass" class="form-control border border-success" required></td>
  						</tr>
  						<tr>
  							<td>New Password</td>
  							<td><input type="password" name="new_pass" class="form-control border border-success" required></td>
  						</tr>
  						<tr>
  							<td>Confirm Password</td>
  							<td><input type="password" name="re_pass" class="form-control border border-success" required></td>
  						</tr>
  					</table>
  					<?php echo $error_pass; ?>
					  <button type="submit" name="pass_submit" class="reg_save_btn">Change Password</button>
  					</div>
  					
  			</div>
  			</form>
  		</div>
  	</div>
<?php
	include 'user_footer.php';
?>