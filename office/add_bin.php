<?php 
	include 'office_header.php';
	$off_id = $_SESSION['off_id'];
	$not_bin = 0;
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$address = $_POST['t1'];
		$lan = $_POST['la'];
		$lon = $_POST['lo'];
		$type = $_POST['bins'];
		$res_check = fetch_gb_by_id($conn,$off_id);
		$check_result = mysqli_fetch_array($res_check);
		if (!strcmp($type,'S')){
			if ($check_result['small_bin']==0){
				$not_bin = 1;
			}
		}
		elseif(!strcmp($type,'L')){
			if ($check_result['large_bin']==0){
				$not_bin = 1;			}
		}
		elseif(!strcmp($type,'C')){
			if($check_result['container']==0){
				$not_bin = 1;
			}
		}

		if ($not_bin==0){
			$res = insert_to_bin($conn,$name,$off_id,$lan,$lon,$address,$type);
			$res2 = reduce_bin_amount($conn,$type,$off_id);
			if($res){
				?>
				<script type="text/javascript">
					alert("Bin Successfully Added");
				</script>
				<?php
			}
		}
		// $sql = "insert into tbl_bins(b_name,gb_id,lat,lon,location) values('$name','$off_id','$lan','$lon','$address')";
	}


?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

	<div class="container m-5 pt-5">
	<?php if($not_bin==1){
		?>
		<div class="row" style="margin-top: -50px; margin-bottom:20px;">
			<div class="alert alert-danger" role="alert">
				Sorry, No more bins available. <a href="request_bin.php" class="alert-link text-decoration-underline">Click here</a> to request for bins
			</div>
		</div>
		<?php
	}  
	?>
  		<div class="row">
  			<div class="col-md-7 office_bg_color2 shadow p-3 mb-5 rounded">
  				<div class="office_txt_head">
  					Add Bin
  				</div>
  				<form method="post" action="">
  				<div class ="container">
  					<div class="row">
  						<div class="col-md-6">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Name</label>
								<input  required="" type="text"name="name" class="form-control">
							</div>
	            		</div>
						<div class="col-md-6">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Type</label>
								<div class="dropdown bg_color_view">
  									<select name="bins" class="form-control" required>
  										<option>Select</option>
										<option value='S'>Small Bin</option>
										<option value='L'>Large Bin</option>
										<option value='C'>Container</option>
									</select>
								</div>
							</div>
	            		</div>
	            		<div class="col-md-8">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Address</label>
								<input  required="" type="text"name="t1" class="form-control">
							</div>
	            		</div>
	            		<div class="col-md-6">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Latitude</label>
								<input  required="" type="text"name="la" id="la" class="form-control">
							</div>
	            		</div>
	            		<div class="col-md-6">
							<div class="office_form-group label-floating">
								<label class="office_control-label">Longitude</label>
								<input  required="" type="text" name="lo" id="lo" class="form-control">
							</div>
	            		</div>
						<div class="d-flex justify-content-center mt-3">
	            		<button class="reg_btn" name="submit" type="submit">Add</button>
						</div>
	            	</div>
	            	
	            </div>
	        	</form>
  			</div>
  			<div class="col-md-5">
  				<div id="office_map2">
  				</div>
  			</div>
  		</div>
  	</div>
<?php 
      $sql_loc="Select * from tbl_office where gb_id = '$off_id'";
      $res_loc = mysqli_query($conn,$sql_loc);
      $row_loc = mysqli_fetch_array($res_loc);
    ?>
<script type="text/javascript">
        var map = L.map('office_map2').setView([<?php echo $row_loc['lat']; ?>,<?php echo $row_loc['lon']; ?>],16);
          L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
          attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
          }).addTo(map);

            map.on('click', function(e) {
				//alert(e.latlng);
            	document.getElementById('la').value = e.latlng['lat'];
				document.getElementById('lo').value = e.latlng['lng'];
        });
  
  </script>
<?php
	include 'office_footer.php';
?>