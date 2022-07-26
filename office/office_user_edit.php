<?php
	include 'office_header.php';
	$off_id = $_SESSION['off_id'];
	$sql_off = "select * from tbl_gb where gb_id = '$off_id'";
	$res_off = mysqli_query($conn,$sql_off);
	$row_off = mysqli_fetch_array($res_off);
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
						<td class="admin_user_edit_td"><?php echo $row_off['gb_name']; ?></td>
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
				<a href="office_remove_user.php?id=<?php echo $user_id ?>"><button class="admin_edit_btn" id="admin_user_remove">Remove User</button></a>
				<a href="office_user.php"><button class="admin_edit_btn">Back</button></a>
			</div>
		</div>
	</div>
<?php
	include 'office_footer.php';
?>