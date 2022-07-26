<?php
	include 'user_header.php';
	include 'map.php';

		$user_id = $_SESSION['user_id'];
		$res = select_user_by_id($conn,$user_id);
		$row=mysqli_fetch_array($res);
		$off_id = $row['gb_id'];
?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
	<div class="container" style="margin-top: 100px;">
		<div class="row mb-3">
			<div class="col-sm-12 text-center mb-5">
					<img src="../assets/img/small_green.ico" width="50px" height="50px"> Small Bin 
                    <img src="../assets/img/large_green.ico" width="50px" height="50px" class="user_bintype_mobView"> Large Bin 
                    <img src="../assets/img/Con_green.ico" width="50px" height="50px"> Container 
			</div>
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
					$res1 = fetch_bin_by_gb($conn,$off_id);
					$i=1;
					while($row1=mysqli_fetch_array($res1)){
					?>
					<form method="post" action="">
					<input type="text" name="id" value="<?php echo $row1['bin_id'];?>" hidden>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row1['b_name']; ?></td>
						<td>
							<?php
								if($row1['status']==0){
									echo "Empty";
								} 
								elseif($row1['status']==1){
									echo "Half";
								}
								else{
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
	$res= fetch_bin_by_gb($conn,$off_id);
    $res_loc = fetch_off_loc_by_id($conn,$off_id);
    $row_loc = mysqli_fetch_array($res_loc);
	map_view($res,$row_loc);
	include 'user_footer.php';
?>