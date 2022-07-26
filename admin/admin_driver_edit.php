<?php
	$make_nav=4;
	include '../db/connection.php';
	include 'admin_header.php';
	if(isset($_GET['id'])){
		$driver_id = $_GET['id'];
	}
	if(isset($_POST['submit'])){
		$driver_id = $_POST['id'];
		$name = $_POST['name'];
		$age=$_POST['age'];
		$gender = $_POST['gender'];
		$username = $_POST['email'];
		$phno = $_POST['phno'];
		$address = $_POST['address'];
		$aadhaar = $_POST['aadhaar'];
		// $exp = $_POST['exp'];
		$pass = $_POST['pass'];
		$sql1 = "update tbl_driver set name='$name',age='$age',gender='$gender',phno='$phno',address='$address',aadhaar='$aadhaar',username='$username',password='$pass' where id='$driver_id'";
		$res2 = mysqli_query($conn,$sql1);
		if($res2){
			?>
			<script type="text/javascript">
				alert("Updated Successfuly");
			</script>
			<?php
		}
	}

	$sql = "select * from tbl_driver where id='$driver_id'";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($res);
?>

	<div class="admin_user_block">
		<div class="admin_user_head">
			<?php
			if($row['type']==2){
				?>
			<div class="admin_driver_head_span2">
				<a href="admin_driver_assign_truck.php?id=<?php echo $driver_id ?>"><button class="admin_driver_btn">Assign/Change Truck</button></a>
			</div>
			<?php
			}
			?>
			<div class="admin_user_head_span1">
				Driver Details
			</div>
			<div class="admin_user_head_span2">
				<button class="admin_edit_btn2" id="admin_driver_editbtn"><i class="bi-pencil-square"></i>&nbsp;edit</button>
			</div>
		</div>
		<div class="admin_user_display">
			<form method="post" action="" id="driver_form">
				<input type="text" name="id" value="<?php echo $driver_id ?>" hidden>
			<div class="admin_user_edit_block">
				<table>
					<tr>
						<td>Name</td>
						<td class="admin_user_edit_td"><input type="text" name="name" value="<?php echo $row['name']; ?>" disabled></td>
					</tr>
					<tr>
						<td>Gender</td>
						<td class="admin_user_edit_td"><input type="text" name="gender" value="<?php echo $row['gender']; ?>" disabled></td>
					</tr>
					<tr>
						<td>Truck Number</td>
						<td class="admin_user_edit_td">
							<?php 
								$sw = "Select truck_no from tbl_truck where driver_id='$driver_id'";
								$rw = mysqli_query($conn,$sw);
								if(mysqli_num_rows($rw)>0){
									while($pr=mysqli_fetch_array($rw)){
										echo $pr['truck_no']."<br>";
									}
								}
								else{
									echo "NOT ASSIGNED";
								}
							?>
						</td>
					</tr>
					<tr>
						<td>Address</td>
						<td class="admin_user_edit_td"><textarea cols=23 rows="3" name="address" disabled><?php echo $row['address']; ?></textarea></td>
					</tr>
					<tr>
						<td>Email id</td>
						<td class="admin_user_edit_td"><input type="text" name="email" value="<?php echo $row['username']; ?>" disabled></td>
					</tr>
				</table>
			</div>
			<div class="admin_user_edit_block">
				<table>
					<tr>
						<td>Age</td>
						<td class="admin_user_edit_td"><input type="text" name="age" value="<?php echo $row['age']; ?>" disabled></td>
					</tr>
					<tr>
						<td>Aadhaar Number</td>
						<td class="admin_user_edit_td"><input type="text" name="aadhaar" value="<?php echo $row['aadhaar']; ?>" disabled></td>
					</tr>
					<tr>
						<td>Job Type</td>
						<td class="admin_user_edit_td"><?php 
																if($row['type']==1)
																	echo "Walking Garbage Collector";
																else
																	echo "Driver";
																	?>
						</td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td class="admin_user_edit_td"><input type="text" name="phno" value="<?php echo $row['phno']; ?>" disabled></td>
					</tr>
					<tr>
						<td>Password</td>
						<td class="admin_user_edit_td"><input type="text" name="pass" value="<?php echo $row['password']; ?>" disabled></td>
					</tr>
				</table>
			</div>
			<div class="admin_driver_align_center" id="admin_driver_submit_btn"><button type="submit" name="submit" id="admin_driver_submitbtn">Save Changes</button></div>
			</form>
			<div class="admin_user_edit_btn">
				<a href="admin_remove_driver.php?id=<?php echo $driver_id ?>"><button class="admin_edit_btn" id="admin_user_remove">Remove Driver</button></a>
				<a href="admin_driver.php"><button class="admin_edit_btn">Back</button></a>
			</div>
		</div>
	</div>
<?php
	include 'admin_footer.php';
?>