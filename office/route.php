<?php
	include 'office_header.php';
	include 'map.php';
		$off_id = $_SESSION['off_id'];
		
?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
	<div class="container m-5" style="height:100vh">
  		<div class="row">
  			<div class="col-md-7 office_bg_color2 shadow p-3 mb-5 rounded">
  				<div class="office_txt_head">
  					Add Bin
  				</div>
  				<form method="post" action="">
  				<div class ="container">
  					<div class="row">
  						<div class="col-md-6 ">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Route Name</label>
								<input  required="" type="text"name="name" class="form-control">
							</div>
	            		</div>
	            		<div class="col-md-10">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Details</label>
								<input  required="" type="text"name="details" class="form-control">
							</div>
	            		</div>
	            		<div class="col-md-8">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Add Bins</label>
								<div class="dropdown bg_color_view">
  									<select name="bins[]" class="form-control js-example-basic-multiple-limit " multiple>
  										<option>Select</option>
  									<?php
										$res = fetch_bin_by_type_wm($conn,$off_id,"L");
										$id = 0;
										while($row1=mysqli_fetch_array($res)){
											$i++;
									?>
    									<option value="<?php echo $row1['bin_id']?>"><?php echo $row1['b_name'];?></option>
    									<?php
    										}
    									?>
									</select>
								</div>
							</div>
	            		</div>
	            	</div>
	            	<center>
	            	<button class="reg_btn margin_top_view" name="submit" type="submit">Calculate Route</button>
	            	</center>
	            </div>
	        	</form>
  			</div>
  			<div class="col-md-5">
  				<div id="office_map2">
  				</div>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  				<div id="office_map3">
  				</div>
  			</div>
  		</div>

<?php
	$res = fetch_bin_by_type_wm($conn,$off_id,"L");
	$sql_loc="Select * from tbl_office where gb_id = '$off_id'";
    $res_loc = mysqli_query($conn,$sql_loc);
    $row_loc = mysqli_fetch_array($res_loc);
?>
<script type="text/javascript">
	$(".js-example-basic-multiple-limit").select2();

	$(".js-example-basic-multiple-limit").on("select2:select",function(evt){
		var element = evt.params.data.element;
		var $element = $(element);

		$element.detach();
		$(this).append($element);
		$(this).trigger("change");
	})
	var map = L.map('office_map2').setView([<?php echo $row_loc['lat']?>,<?php echo $row_loc['lon']?>],16);
	L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
		attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
	}).addTo(map);
	<?php
	while($row=mysqli_fetch_array($res)){?>
	var marker = L.marker([<?php echo $row['lat']; ?>, <?php echo $row['lon']; ?>]).addTo(map);
	marker.bindPopup("<?php echo $row['b_name']; ?>");
	<?php
	}
	?>	

	</script>
	
<?php
		if (isset($_POST['submit'])) {
			$value = $_POST['bins'];
			$r_name = $_POST['name'];
			$de = $_POST['details'];
			$_SESSION['route_value']=$value;
			$_SESSION['name']=$r_name;
			$_SESSION['details']=$de;
			$arr_lat = array();
			$arr_lon = array();
			foreach ($value as $i){
				$sql2 = "select lat,lon from tbl_bins where bin_id ='$i'";
				$res2=mysqli_query($conn,$sql2);
				$row2=mysqli_fetch_array($res2);
				array_push($arr_lat,$row2['lat']);
				array_push($arr_lon,$row2['lon']);
				$last;
			}
			$len = count($arr_lat);
				?>
				<script type="text/javascript">
				var map = L.map('office_map3').setView([<?php echo $row_loc['lat']?>,<?php echo $row_loc['lon']?>],16);
				L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
				attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
					}).addTo(map);
				L.Routing.control({
 	 				waypoints: [
 	 				<?php
 	 					for($i=0;$i<$len;$i++) {
 	 					$last = $i;
 	 				?> 	 					
 	 					
    					L.latLng(<?php echo $arr_lat[$i]?>,<?php echo $arr_lon[$i]?>),
    				<?php } ?>
    					
  						]	
				}).addTo(map);
				</script>
				<?php
		}
?>
		<center>
			<a href="route_add_action.php">
				<button class="reg_btn margin_top_view" name="transfer" type="button">Save Route</button>
			</a>
		</center>
		<br><br>
<?php
	include 'office_footer.php';
?>