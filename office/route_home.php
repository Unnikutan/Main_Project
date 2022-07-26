<?php
	include 'office_header.php';
	
		$off_id=$_SESSION['off_id'];

	if(isset($_POST['day_submit'])){
		if ($_POST['route_day']==1){
			$day = date('w');
		}
		else{
			$day = 0;
		}
	}
	else{
		$day = 0;
	}
?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <div class="container m-5">
        <div class="d-flex justify-content-between align-items-center">
          <div class="container">
			<div class="row">
				<div class="col-sm-2">
					<a href="route.php" style="color: black">
						<button type="button" class="reg_btn_route">Add Route <i class="bi-distribute-horizontal"></i></button>
	      			</a>
	      		</div>
				<div class="col-sm-2 ">
					<a href="route_edit.php" style="color: black">
						<button type="button" class="reg_btn_route">Edit Route <i class="bi-geo-fill"></i></button>
	      			</a>	
				</div>
				<div class="col-sm-2 ">	
					<a href="route_assign_truck.php" style="color: black">
						<button type="button" class="reg_btn_route">Assign Truck <i class="bi-check-lg"></i></button>
	      			</a>	
				</div>
			</div>
		</div>
    </div>


	<div class="container m-5">
		<div class="row">
			<div class="col-md-5 office_bg_color shadow p-3 mb-5 rounded" style="height: 70vh;">
				<div class="office_txt_head">
  					Routes
  				</div>
				  <form method="post" action="">
                    <div class="text-center p-4 border-bottom">
                        Day : 
                        <select name="route_day" class="w-25 mx-2 p-1 rounded bg-light text-center">
                            <option value=2>All Days</option>
                            <option value=1>Today</option>
                        </select>
                        <button type="submit" name="day_submit" class="btn btn-dark py-0">Submit</button>
                    </div>
                </form>
  				<div class="table_overflow" style="height: 80%;">
				<table class="table table-hover">
					<tr >
						<th>#</th>
						<th>Route_name</th>
						<th>Truck Number</th>
						<th>Route Day</th>
					</tr>
					<?php
					$res1 = select_route_by_day_gb($conn,$day,$off_id);
					$i=1;

					while($row1=mysqli_fetch_array($res1)){
						
					?>
					<form method="post" action="">
					<input type="text" name="id" value="<?php echo $row1['route_id'];?>" hidden>
					<tr class="align-middle">
						<td><?php echo $i; ?></td>
						<td><Button class="btn btn-light" name='submit' type='submit'><?php echo $row1['route_name']; ?></Button></td>
						<td><?php 
								if(empty($row1['truck_no'])){
									echo "Not Assigned";
								}
								else{
									echo $row1['truck_no'];
								}
							?>
						</td>
						<td>
						<?php 
								if($row1['day']==0){
									echo "Not Assigned";
								}
								else{
									if($row1['day']==1){
										echo "Monday";
									}
									elseif($row1['day']==2){
										echo "Tuesday";
									}
									elseif($row1['day']==3){
										echo "Wednesday";
									}
									elseif($row1['day']==4){
										echo "Thursday";
									}
									elseif($row1['day']==5){
										echo "Friday";
									}
									elseif($row1['day']==6){
										echo "Saturday";
									}
									elseif($row1['day']==7){
										echo "Sunday";
									}
								}
							?>
						</td>
					</tr>
					</form>
					<?php
						$i++;
						}
					?>
				</table>
			</div>
			</div>
			<div class="col-md-7">
  				<div id="office_map2">
  				</div>
  			</div>
		</div>
	</div>

<?php
	
	if(isset($_POST['submit'])){
		$route_id = $_POST['id'];
		$sql2 = "select * from tbl_route_details where route_id = '$route_id' ";
		$res2 = mysqli_query($conn,$sql2);
      	$sql_loc="Select * from tbl_office where gb_id = '$off_id'";
      	$res_loc = mysqli_query($conn,$sql_loc);
      	$row_loc = mysqli_fetch_array($res_loc);
		?>
	<script type="text/javascript">
				var map = L.map('office_map2').setView([<?php echo $row_loc['lat']?>,<?php echo $row_loc['lon']?>],16);
				L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
				attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
				}).addTo(map);
				L.Routing.control({
 	 			waypoints: [
 	 			<?php
 	 			while($len=mysqli_fetch_array($res2)) {
	 	 			$bin_id = $len['bins'];
	 	 			$sql4 = "select * from tbl_bins where bin_id='$bin_id'";
	 	 			$result = mysqli_query($conn,$sql4);
	 	 			$val = mysqli_fetch_array($result);
	 	 			?>
	 	 			L.latLng(<?php echo $val['lat']?>, <?php echo $val['lon']?>),
 	 			<?php } ?>
  					]	
				}).addTo(map);
	</script>
	<?php
	}
	else{
	$sql = "Select * from tbl_bins";
	$res = mysqli_query($conn,$sql);
?>

<?php
		}	
	include 'office_footer.php';
?>