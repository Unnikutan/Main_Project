<?php
	include 'office_header.php';
	
		$off_id = $_SESSION['off_id'];
?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<div class="d-block container p-0 h-100">
		<div class="row m-5">
			<div class="col-md-12 office_bg_color shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					All Routes
  				</div>
  				<div class="table_overflow">
				<table class="table table-hover">
					<tr>
						<th>#</th>
						<th>Route_name</th>
						<th>Route Details</th>
						<th>Truck Number</th>
						<th>Bins Collecting</th>
						<th>Action</th>
					</tr>
					<?php
					$sql1 = "Select * from tbl_route where gb_id = '$off_id'";
					$res1 = mysqli_query($conn,$sql1);
					$i=1;
					while($row1=mysqli_fetch_array($res1)){
						$id = $row1['route_id'];
						$sql_renew = "Select * from tbl_route_details where route_id='$id'";
						$res_renew = mysqli_query($conn,$sql_renew);
						$num = mysqli_num_rows($res_renew);
					?>

					<form method="post" action="">
					<input type="text" name="id" value="<?php echo $id ?>" hidden>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row1['route_name']; ?></td>
						<td><?php echo $row1['details']; ?></td>
						<td class="view_align_center"><?php echo $row1['truck_no'] ?></td>
						<td><?php echo $num ?></td>
						<td><button type="submit" name="submit" class="view_btn">View</button>
							<a href="route_delete.php?id=<?php echo $row1['route_id']?>"><button id="admin_edit_remove" type="button" class="del_btn">Delete</button></a></td>
					</tr>
					</form>
					<?php
						$i++;
						}
					?>
				</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
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
?>
<?php
	include 'office_footer.php';
?>