<?php
	include 'header.php';
	$dr_id = $_SESSION['worker_id'];
		if(!isset($error_pass)){
			$error_pass="";
		}
		if (isset($_POST['p_submit'])){
			$name = $_POST['name'];
			$age = $_POST['age'];
			$gender = $_POST['gender'];
			$username = $_POST['user'];
			$aadhaar = $_POST['adhar'];
			$phno = $_POST['phno'];
			$address = $_POST['address'];
			$sql1 = "update tbl_driver set name='$name',age='$age',gender='$gender',username='$username',aadhaar='$aadhaar',phno='$phno',address='$address' where id='$dr_id'";
			$result = mysqli_query($conn,$sql1);
			if($result){
				$sql2 = "update tbl_login set username='$username' where type=2 and enter_id='$dr_id'";
				$result2=mysqli_query($conn,$sql2);
				?>
				<script type="text/javascript">
					alert("Data Updated");
				</script>
				<?php
			}
		}
		if(isset($_POST['pass_submit'])){
			$cur_pass = $_POST['cur_pass'];
			$new_pass = $_POST['new_pass'];
			$re_pass = $_POST['re_pass'];
			$sql4 = "Select password from tbl_driver where id='$dr_id'";
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
				$sql_ins = "update tbl_driver set password='$new_pass' where id = '$dr_id'";
				$res_ins = mysqli_query($conn,$sql_ins);
				if($res_ins){
					$sql_lo = "update tbl_login set password='$new_pass' where type=2 and enter_id = '$dr_id'";
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
			$('#job_details_content').hide();
			$('#password_change_content').hide();

			$('#first_content_link').addClass("active");
			$('#second_content_link').removeClass("active");
			$('#third_content_link').removeClass("active");
		})

		$('#second_link').click(function(){
			$('#password_change_content').hide();
			$('#job_details_content').show();
			$('#personal_details_content').hide();
			$('#second_content_link').addClass("active");
			$('#first_content_link').removeClass("active");
			$('#third_content_link').removeClass("active");
		})

		$('#third_link').click(function(){
			$('#password_change_content').show();
			$('#job_details_content').hide();
			$('#personal_details_content').hide();
			$('#second_content_link').removeClass("active");
			$('#first_content_link').removeClass("active");
			$('#third_content_link').addClass("active");
		})

	});
</script>
<section class="breadcrumbs p-0">
    <div class="container">
		<ul class="nav nav-tabs">
			<li class="nav-item" id="first_link">
				<div class="nav-link active" id="first_content_link">Personal</div>
			</li>
			<li class="nav-item" id="second_link" >
				<div class="nav-link" id="second_content_link">Job details</div>
			</li>
			<li class="nav-item" id="third_link" >
				<div class="nav-link" id="third_content_link">Password Change</div>
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
  				<form id="myform" method="post" action="">
  				<div class="row">
	  				<div class="col-md-6">
	  					<div class="driver_table">
	  						<?php 
	  							$sql = "Select * from tbl_driver where id='$dr_id'";
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
		  							<td> Job </td>
		  							<td> <h3 class="text-left">Garbage Collector</h3></td>
		  						</tr>
		  						<tr>
		  							<td> Email </td>
		  							<td><input type="email" name="user" class="form-control" style="margin-bottom: 0px;" value="<?php echo $row['username'] ?>" disabled></td>
		  						</tr>
		  					</table>
		  				</div>
	  				</div>
	  				<div class="col-md-5">
	  					<div class="driver_table">
	  						<?php 
	  							$sql = "Select * from tbl_driver where id='$dr_id'";
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

		  <div class="row" id="job_details_content" style="display: none;">
			<div class="col-md-12 shadow p-3 mb-5 rounded">
  				<form id="myform" method="post" action="">
				<?php 
					$job_query = "select * from tbl_driver where id = '$dr_id'";
					$res_job = mysqli_query($conn,$job_query);
					$row_job = mysqli_fetch_array($res_job);
				?>
  				<div class="row mt-2">
					<div class="col-sm-12 text-center mb-4">
						<div style="font-size:20px; font-weight:bold;">Job : <span style="font-size: 30px;"> Garbage Collector</span></div> 
						<div style="font-size:20px; font-weight:bold;">WM : 
							<span style="font-size: 30px;">
								<?php 
									$sql_off = fetch_gb_by_id($conn,$row_job['gb_id']);
									$res_off = mysqli_fetch_array($sql_off);
									echo $res_off['gb_name'];
								?>
							</span>
						</div> 
					</div>
	  				<div class="col-md-6">
	  					<div class="driver_table">
							<?php 
								$binWr = "select b_name from tbl_bins where pick_up = '$dr_id'";
								$res_binWr = mysqli_query($conn,$binWr);
							?>
		  					<table>
		  						<tr>
		  							<td> Bins Assigned </td>
		  							<td> <input class="form-control text-center" style="margin-bottom: 0px;" value="<?php echo mysqli_num_rows($res_binWr) ?>" disabled></td>
		  						</tr>
		  						<tr>
		  							<td> Bin Names </td>
		  							<td> 
										<div class="form-control border" style="margin-bottom: 0px; background-color:#e9ecef; height:25vh; overflow:auto;"  disabled>
										<?php 
											while($row_truckDr = mysqli_fetch_array($res_binWr)){
												echo $row_truckDr['b_name']."<br>";
											}
										?> 
										</div>
									</td>
		  						</tr>
		  					</table>
		  				</div>
	  				</div>
	  				<div class="col-md-5">
	  					<div class="driver_table">
		  					<table>
								<?php
								$routeDr = "Select r.route_id,r.route_name,t.truck_no from tbl_route r inner join tbl_truck t on t.truck_no = r.truck_no where t.driver_id = '$dr_id'";
								$res_routeDr = mysqli_query($conn,$routeDr);

								?>
		  						<tr>
		  							<td> Fully Loaded Bins</td>
									<?php 
										$query_bin = "select * from tbl_bins where pick_up = '$dr_id' and status = '2'";
										$res_bin = mysqli_query($conn,$query_bin);
									?>
		  							<td> <input class="form-control user_table_td text-center" style="margin-bottom: 0px;" value="<?php echo mysqli_num_rows($res_bin) ?>" disabled></td>
		  						</tr>
								<tr>
		  							<td> Halfly Loaded Bins </td>
									  <?php 
										$query_bin = "select * from tbl_bins where pick_up = '$dr_id' and status = '1'";
										$res_bin = mysqli_query($conn,$query_bin);
									?>
		  							<td> <input class="form-control user_table_td text-center" style="margin-bottom: 0px;" value="<?php echo mysqli_num_rows($res_bin) ?>" disabled></td>
		  						</tr>
								<tr>
		  							<td> Empty Bins </td>
									  <?php 
										$query_bin = "select * from tbl_bins where pick_up = '$dr_id' and status = '0'";
										$res_bin = mysqli_query($conn,$query_bin);
									?>
		  							<td> <input class="form-control user_table_td text-center" style="margin-bottom: 0px;" value="<?php echo mysqli_num_rows($res_bin) ?>" disabled></td>
		  						</tr>
		  					</table>
		  				</div>
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
	include 'footer.php';
?>