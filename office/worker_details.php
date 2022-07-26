<?php
	include 'office_header.php';
	$off_id = $_SESSION['off_id'];
	$res_off = fetch_gb_by_id($conn,$off_id);
	$row_off = mysqli_fetch_array($res_off);
	$worker_id = $_GET['id'];
	$sql = "select * from tbl_driver where id = '$worker_id'";
	$res = fetch_driver_by_id($conn,$worker_id);
	$row = mysqli_fetch_array($res);
?>

<div class="admin_user_block">
		<div class="admin_user_head">
			<?php
				if($row['type'] == 1){
			?>
			<div class="admin_driver_head_span2">
				<a href="worker_assign_bin.php?worker_id=<?php echo $worker_id ?>"><button class="admin_driver_btn">View Assigned Bin</button></a>
			</div>
			<?php
				}
			?>
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
						<td class="admin_user_edit_td"><?php echo $row['username']; ?></td>
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
						<td>Job Type</td>
						<td class="admin_user_edit_td">
							<?php 
								if($row['type']==1){
									echo "Walking Garbage Collector";
								}
								else{
									echo "Driver";
								}

							?>
						</td>
					</tr>
					<tr>
						<?php 
							if($row['type']==1){
								?>
								<td> Bins Assigned</td>
								<td class="admin_user_edit_td">
									<?php 
										$bins = fetch_bin_by_collector($conn,$worker_id,$off_id);
										echo mysqli_num_rows($bins);
									?>
								</td>
								<?php
							}
							else{
								?>
								<td>Truck Assigned</td>
								<td class="admin_user_edit_td">
									<?php 
										$truck = fetch_truck_by_driver($conn,$worker_id);
										while($tr_no = mysqli_fetch_array($truck)){
											echo $tr_no['truck_no']."<br>";
										}
									?>
								</td>
								<?php
							}
						?>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td class="admin_user_edit_td"><?php echo $row['phno']; ?></td>
					</tr>
				</table>
			</div>
			<div class="admin_user_edit_btn">
				<a href="worker.php"><button class="admin_edit_btn">Back</button></a>
			</div>
		</div>
	</div>