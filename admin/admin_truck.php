<?php 
	$make_nav=3;
	include '../db/connection.php';
	include 'admin_header.php';
	include '../controls/admin_controls.php';
	if(isset($_POST["submit"])){
		$truck_no = $_POST['truck_no'];
		$gb_id = $_POST['gb_id'];
		$sql_1 = "insert into tbl_truck(truck_no,gb_id) values('$truck_no','$gb_id')";
		$res_1 = mysqli_query($conn,$sql_1);
		if($res_1){
			?>
			<script type="text/javascript">
				alert("Truck Added");
			</script>
			<?php
		}
		else{
			?>
			<script type="text/javascript">
				alert("Truck already exist");
			</script>
			<?php
		}

	}
?>
<div class="container mt-3">
	<div class="admin_row_2">
		<button id ="admin_add_muni"class="admin_btn3">Add new truck</button>
	</div>
	<div class="admin_add_truck">
		<form method="post" action="">
			<div class="admin_add_mnc_form">
				<table>
					<tr>
						<td>Truck Number</td>
						<td><input class="admin_input" type="text" name="truck_no" required></td>
					</tr>
					<tr>
						<td>Select Office</td>
						<td>
							<select class="admin_input_select" name="gb_id" required>
								<?php
                    			$result2 = fetch_all_gb($conn); 
                  				while ($row2 = mysqli_fetch_array($result2)) {
								?>
								<option value="<?php echo $row2['gb_id'];?>"><?php echo $row2['gb_name']; ?></option>
								<?php
								}
								?>	
							</select>
						</td>
					</tr>
				</table>
				<div class="admin_mnc_btn">
					<button type="submit" name="submit" class="login_btn2">Submit</button>
					<button id="admin_back_btn1" type="button" class="login_btn2">Back</button>
				</div>
			</div>
		</form>
	</div>
	<div class="admin_mnc_head brd">
		List of Trucks
	</div>
	<div class="admin_mnc_details">
		<table>
			<tr>
				<th>No</th>
				<th class="wd">Truck Number</th>
				<th class="wd">Thaluk</th>
				<th>Driver </th>
				<th>Action</th>
			</tr>
			<?php
				$result2 = fetch_all_trucks($conn);
				if(mysqli_num_rows($result2)>0){
				$i = 1;
				while($row1 = mysqli_fetch_array($result2)){
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row1['truck_no'];?></a></td>
				<td>
					<?php 
						$off_id = $row1['gb_id'];
						if(empty($off_id)){
							echo "Main Office";
						}
						else{
							$res_gb = fetch_gb_by_id($conn,$off_id);
							$row_gb = mysqli_fetch_array($res_gb);
							echo $row_gb['gb_name']; 
						}
					?>
						
				</td>
				<td><div class="cnr"></div>
					<?php
						if($row1['driver_id']==NULL){
							echo "NOT ASSIGNED";
						}
						else{
							$dr_id = $row1['driver_id'];
							$sql_dr = "Select name from tbl_driver where id = '$dr_id'";
							$res_dr = mysqli_query($conn,$sql_dr);
							$row_dr = mysqli_fetch_array($res_dr);
							echo $row_dr['name'];
						} 
					?>
				</td>
				<td><a href="admin_truck_remove.php?id=<?php echo $row1['truck_no'];?>"><button class="admin_edit_btn2" id="admin_edit_remove"> <i class="bi-trash-fill"></i> remove</button></a></td>
			</tr>
			<?php
			$i++;
			}
		}
		?>
		</table>
		<?php
		if(mysqli_num_rows($result2)==0){
			?>
			<div class="admin_no_data_align">No data</div>
			<?php
		}
		?>
	</div>
	</div>

<?php 
	include 'admin_footer.php';
?>