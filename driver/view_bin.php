<?php
	include '../db/connection.php';
	include 'driver_header.php';
	include '../controls/admin_controls.php';
	include 'map.php';
	$dr_id = $_SESSION['driver_id'];
	$driver_sel = fetch_driver_by_id($conn,$dr_id);
	$gb_fet = mysqli_fetch_array($driver_sel);
	$off_id = $gb_fet['gb_id'];
	
		?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
	<div class="container mt-5 py-5">
		<div class="row">
			<div class="col-md-5 office_bg_color shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					Bins
  				</div>
  				<div class="table_overflow">
				<table class="table table-hover">
					<tr>
						<th>#</th>
						<th>Bin</th>
						<th>Status</th>
					</tr>
					<?php
					//$sql1 = "Select * from tbl_bins where gb_id = '$off_id'";
					$res1 = fetch_bin_by_type_wm($conn,$off_id,"L");
					$i=1;
					while($row1=mysqli_fetch_array($res1)){
					?>
					<form method="post" action="">
					<input type="text" name="id" value="<?php echo $row1['bin_id'];?>" hidden>
					<tr>
						<td><?php echo $i; ?></td>
						<td><Button class="btn btn-light border border-dark" name='submit' type='submit'><?php echo $row1['b_name']; ?></Button></td>
						<td>
							<?php 
								if($row1['status']==0){
									echo "Empty";
								}
								elseif($row1['status']==1){
									echo "Half";
								}
								elseif($row1['status']==2){
									echo "Full";
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
		$bin_id = $_POST['id'];
		echo $bin_id;
		$sql2 = "select * from tbl_bins where bin_id = '$bin_id' ";
		$res2 = mysqli_query($conn,$sql2);
		map_each_bin($res2);
	}
	else{
		//$sql = "Select * from tbl_bins where gb_id='$off_id'";
		$res = fetch_bin_by_type_wm($conn,$off_id,"L");
		if(empty($off_id)){
			$row_loc = array('lat'=>'8.957796454971353','lon'=>'76.98957829736175');
		}
		else{
			$sql_loc="Select * from tbl_office where gb_id = '$off_id'";
			$res_loc = mysqli_query($conn,$sql_loc);
			$row_loc = mysqli_fetch_array($res_loc);
		}
		map_view($res,$row_loc);
    ?>
	
<?php
		}
	include 'driver_footer.php';
?>