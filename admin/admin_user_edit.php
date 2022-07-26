<?php
	$make_nav=6;
	include '../db/connection.php';
	include 'admin_header.php';
	$user_id = $_GET['id'];
	$sql = "select * from tbl_user where u_id = '$user_id'";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($res);
?>

	<div class="admin_user_block">
		<div class="admin_user_head">
			<div class="admin_user_head_span1">
				User Details
			</div>
		</div>
		<div class="admin_user_display">
			<div class="admin_user_edit_block">
				<table>
					<tr>
						<td>Name</td>
						<td class="admin_user_edit_td"><?php echo $row['name']; ?></td>
					</tr>
					<tr>
						<td>Gender</td>
						<td class="admin_user_edit_td"><?php echo $row['gender']; ?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td class="admin_user_edit_td"><?php echo $row['address']; ?></td>
					</tr>
					<tr>
						<td>Office</td>
						<td class="admin_user_edit_td">
							<?php
								$gb_id = $row['gb_id'];
								$sql2 = "Select gb_name from tbl_gb where gb_id = '$gb_id'";
								$res2 = mysqli_query($conn,$sql2);
								$row2 = mysqli_fetch_array($res2);
								echo $row2['gb_name'];
							?>
						</td>
					</tr>
					<tr>
						<td>Email id</td>
						<td class="admin_user_edit_td"><?php echo $row['email']; ?></td>
					</tr>
				</table>
			</div>
			<div class="admin_user_edit_block">
				<table>
					<tr>
						<td>Age</td>
						<td class="admin_user_edit_td"><?php echo $row['age']; ?></td>
					</tr>
					<tr>
						<td>Aadhaar Number</td>
						<td class="admin_user_edit_td"><?php echo $row['aadhaar']; ?></td>
					</tr>
					<tr>
						<td>Pin</td>
						<td class="admin_user_edit_td"><?php echo $row['pin']; ?></td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td class="admin_user_edit_td"><?php echo $row['phno']; ?></td>
					</tr>
					<tr>
						<td>Password</td>
						<td class="admin_user_edit_td"><?php echo $row['password']; ?></td>
					</tr>
				</table>
			</div>
			<div class="admin_user_edit_btn">
				<a href="admin_remove_user.php?id=<?php echo $user_id ?>"><button class="admin_edit_btn" id="admin_user_remove">Remove User</button></a>
				<a href="admin_user.php"><button class="admin_edit_btn">Back</button></a>
			</div>
		</div>
	</div>
<?php
	include 'admin_footer.php';
?>