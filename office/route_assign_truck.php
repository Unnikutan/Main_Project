<?php
	include 'office_header.php';
	
		$gb_id = $_SESSION['off_id'];
		$sql = "SELECT * FROM tbl_route where gb_id = '$gb_id'";
		$res = mysqli_query($conn,$sql);
?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
	<div class="container m-5">
		<div class="row">
			<div class="col-md-12 office_bg_color shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					Assign Truck to Routes
  				</div>
  				<center>
  				<?php 
  					if (isset($_POST['find'])){
  						$route_id = $_POST['route_id'];
  						$sql2 = "SELECT * FROM tbl_route where route_id='$route_id'";
  						$result = mysqli_query($conn,$sql2);
  						$row2 = mysqli_fetch_array($result);
  					?>
          <div class="office_truck_view_2 m-5">
   				<table style="margin: 50px 20px">
   					<form method="post" action="route_update.php">
   					<input type="text" name="route_id" value="<?php echo $row2['route_id']?>"hidden>
  					<tr>
  						<th> Route </th>
  						<td><?php echo $row2['route_name'] ?></td>
  					</tr>
  					<tr>
  						<th>Current Truck</th>
  						<td><?php 
  							if($row2['truck_no']){ 
  								echo $row2['truck_no'];
  							} 
  							else{
  								echo "NOT ASSIGNED";
  							}
  							?>
  						</td>
  					</tr>
  					<tr>
  						<th> Select Truck</th>
  						<?php 
  							$sql3 = "Select * from tbl_truck where gb_id='$gb_id'";
  							$res2 = mysqli_query($conn,$sql3);
  						?>
  						<td>
  							<select name="truck_select" class="form-select" required>
  								<?php 
  								while($row3=mysqli_fetch_array($res2)){ ?>
  								<option><?php echo $row3['truck_no']?></option>
  							<?php } ?>
  							</select>
  						</td>
  					</tr>
  					<tr>
  						<th> Day</th>
  						<td> <select name="date" class="form-select" required>
								<option value="1">Monday</option>	
								<option value="2">Tuesday</option>
								<option value="3">Wednesday</option>
								<option value="4">Thursday</option>
								<option value="5">Friday</option>
								<option value="6">Saturday</option>
								<option value="7">Sunday</option>
							</select>
						</td>
  					</tr>
  				</table>
  				<button type="submit" name="submit" class="reg_btn">Submit</button>
  				<a href="route_assign_truck.php"><button type="button" name="submit" class="reg_btn">Back</button></a>
  			</form>
  			<?php } 
  					else{
  			?>
  				<form method="post" action="">
            <center>
            <div class="office_truck_view_1">
      				<table>
      					<tr>
      						<th> Select Route</th>
      						<td><select name="route_id" class="truck_assign_select" required>
      							<?php 
      							while($row=mysqli_fetch_array($res)){
      							?>
      							<option value="<?php echo $row['route_id']?>"><?php echo $row['route_name'];?></option>
      						<?php } ?>
      						</select></td>
      					</tr>
      				</table>
            </div>
          </center>
  				<button type="submit" name="find" class="reg_btn">Select</button>
  			</form>
  			<?php } ?>
  			</center>
  			</div>
  		</div>
  	</div>


<?php
	include 'office_footer.php';
?>