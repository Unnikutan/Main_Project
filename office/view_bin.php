<?php
	include 'office_header.php';
	include 'map.php';
		$off_id = $_SESSION['off_id'];
?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
	<div class="container m-5">
		<div class="row justify-content-center d-none" >
			<div class="col-sm-6">	
				<div class="alert alert-danger" role="alert">Some Bins are Full</div>
			</div>
		</div>
		<div class="row pt-5">
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
						<th></th>
					</tr>
					<?php
					$sql1 = "Select * from tbl_bins where gb_id = '$off_id'";
					$res1 = mysqli_query($conn,$sql1);
					$i=1;
					while($row1=mysqli_fetch_array($res1)){
					?>
					<form method="post" action="">
					<input type="text" name="id" value="<?php echo $row1['bin_id'];?>" hidden>
					<tr>
						<td><?php echo $i; ?></td>
						<td><Button name='submit' type='submit'><?php echo $row1['b_name']; ?></Button></td>
						<td><a href="bin_status.php?id=<?php echo $row1['bin_id'] ?>"><button type="button">View Status</button></a></td>
						<td><a href="bin_remove.php?id=<?php echo $row1['bin_id'] ?>"><button class="btn_bin_clear" type="button" onclick="return confirm('Are you sure want to delete')"><i class="bi-trash-fill"></i></button></td>
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
		$sql_loc="Select * from tbl_bins where bin_id = '$bin_id' ";
		$res_loc = mysqli_query($conn,$sql_loc);
		$row_loc = mysqli_fetch_array($res_loc);
		$sql2 = "select * from tbl_bins where bin_id = '$bin_id' ";
		$res2 = mysqli_query($conn,$sql2);
		map_view($res2,$row_loc);
	}
	else{
		$sql = "Select * from tbl_bins where gb_id='$off_id'";
		$res = mysqli_query($conn,$sql);
		$sql_loc="Select * from tbl_office where gb_id = '$off_id'";
		$res_loc = mysqli_query($conn,$sql_loc);
		$row_loc = mysqli_fetch_array($res_loc);
		map_view($res,$row_loc);
	}	
	include 'office_footer.php';
?>