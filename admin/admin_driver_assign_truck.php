<?php
    $make_nav=4;
	include '../db/connection.php';
	include 'admin_header.php';
	if (isset($_POST['submit'])){
		$driver_id = $_POST['id'];
		$truck_no = $_POST['truck_no'];
		$sql_up2 = "update tbl_truck set driver_id='$driver_id' where truck_no='$truck_no'";
		$res2 = mysqli_query($conn,$sql_up2);
			if($res2){
				?>
				<script type="text/javascript">
					alert("Successfully Updated");
					window.location.href="admin_driver.php";
				</script>
				<?php
			}
	}
	if (isset($_POST['remove'])){
		$driver_id = $_POST['id'];
		//$truck_no = $_POST['truck_no'];
		$sql_up2 = "update tbl_truck set driver_id=NULL where driver_id='$driver_id'";
		$res2 = mysqli_query($conn,$sql_up2);
			if($res2){
				?>
				<script type="text/javascript">
					alert("Successfully Updated");
					window.location.href="admin_driver.php";
				</script>
				<?php
			}
	}
	if(isset($_GET['id'])){
		$driver_id = $_GET['id'];
	}
	elseif (isset($_POST['assign'])) {
		$driver_id = $_POST['id'];
	}
	if(!isset($driver_id)){
	?>
	<div class="admin_edit_sel">
		<form method="post" action="">
		<table>
			<tr>
				<td><div div class="admin_edit_txt">Select Driver </div></td>
				<td>
					<select class="admin_input_select" name="id">
						<?php
							$sql = "select id,name from tbl_driver";
							$res = mysqli_query($conn,$sql);
							while($row=mysqli_fetch_array($res)){
						?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr>
		</table>
		<button type="submit" name="assign">Submit</button>
		</form>
	</div>
	<?php
	}
	else{
		$sql = "Select * from tbl_driver where id = '$driver_id'";
		$res = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($res); 
		$next = "Select * from tbl_truck where driver_id = '$driver_id'";
		$res_next = mysqli_query($conn,$next);
		?>

			<div class="admin_user_block">
				<div class="admin_user_head">
					<div class="admin_user_head_span1">
						Assign Truck
					</div>
				</div>
				<div class="admin_driver_display">
					<div class="admin_driver_edit_block">
						<form method="post" action="" id="driver_form">
							<input type="text" name="id" value="<?php echo $row['id']; ?>" hidden>
							<table>
								<tr>
									<td>Driver Name</td>
									<td><?php echo $row['name']; ?></td>
								</tr>
								<tr>
									<td>Current Truck</td>
									<td>
										<?php
											$next = "Select * from tbl_truck where driver_id = '$driver_id'";
											$res_next = mysqli_query($conn,$next);
											if(mysqli_num_rows($res_next)>0){
												while($row_next=mysqli_fetch_array($res_next)){
													echo $row_next['truck_no']."<br>";
												}
											}
											else{
												echo "NOT ASSIGNED";
											}
										?>
									</td>
								</tr>
								<tr>
									<td>Change Truck</td>
									<td>
										<?php
											$tr = "select truck_no from tbl_truck where driver_id is null";
											$result = mysqli_query($conn,$tr);
											if(mysqli_num_rows($result)>0){
										?>
										<select name="truck_no">
										<?php 
											while($rw=mysqli_fetch_array($result)){
												?>
												<option><?php echo $rw['truck_no']; ?></option>
												<?php
											}
										}
										else{
											echo " No Truck Available";
										}
										?>
										</select>
									</td>
								</tr>
							</table>
							<?php
							if(mysqli_num_rows($result)>0){
								?>
								<button type="submit" name="submit" id="admin_driver_submitbtn">Assign New Truck</button>
								<?php
							}
							else{
								?>
								<button type="submit" name="submit" id="admin_driver_submitbtn" disabled>Assign New Truck</button>
								<?php
							}
							if(mysqli_num_rows($res_next)>0){
								?>
								<button type="submit" name="remove" id="admin_driver_submitbtn">Remove All Truck</button>
								<?php
							}
							else{
								?>
								<button type="submit" name="submit" id="admin_driver_submitbtn" disabled>Remove All Truck</button>
								<?php
							}
							?>
						</form>
					</div>
				</div>
			</div>
		<?php
	}
?>

<?php
	include 'admin_footer.php';
?>