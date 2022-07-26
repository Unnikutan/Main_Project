<?php
	include 'office_header.php';
	$off_id=$_SESSION['off_id'];
?>
<script src="../leaflet/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<section id="office_content">
	<div class="container">
		<div class="row">
			<div class="col-md-5 office_bg_color shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					User Compliants
  				</div>
  				<div class="table_overflow">
				<table class="table table-hover">
					<thead class="table-dark">
					<tr>
						<th>#</th>
						<th>User Name</th>
						<th>Complaint</th>
						<th>Action</th>
					</tr>
					</thead>
					<?php
						$sql = "Select * from tbl_comp where type=1 and gb_id = '$off_id' and status=0";
						$res = mysqli_query($conn,$sql);
						$i = 1;
						while ($row=mysqli_fetch_array($res)) {
							$id = $row['enter_id'];
							$sql2 = "Select * from tbl_user where u_id = '$id'";
							$res2 = mysqli_query($conn,$sql2);
							$row2 = mysqli_fetch_array($res2);
							?>
							
							<tr><a href="done.php"> 
								<td><?php echo $i ?></td>
								<td><?php echo $row2['name']?></td>
								<td><?php echo $row['topic'];?></td>
								<td><a href="comp_view.php?id=<?php echo $row['id']?>"><button class="admin_edit_btn2" type="button">View details</button></a></td>
							</a>
							</tr>
							<?php
							$i++;
						}
					?>
				</table>
			</div>
			</div>
			<div class="col-md-5 office_complaint shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					Driver Compliants
  				</div>
  				<div class="table_overflow">
				<table class="table table-hover">
					<thead class="table-dark">
					<tr>
						<th>#</th>
						<th>Driver Name</th>
						<th>Complaint</th>
						<th>Action</th>
					</tr>
					</thead>
					<?php
						$sql = "Select * from tbl_comp where type=2 and gb_id = '$off_id' and status = 0 ";
						$res = mysqli_query($conn,$sql);
						$j = 1;
						while ($row=mysqli_fetch_array($res)) {
							$id = $row['enter_id'];
							$sql2 = "Select * from tbl_driver where id = '$id'";
							$res2 = mysqli_query($conn,$sql2);
							$row2 = mysqli_fetch_array($res2);
							?>
							<tr>
								<td><?php echo $j ?></td>
								<td><?php echo $row2['name']?></td>
								<td><?php echo $row['topic'];?></td>
								<td><a href="comp_view.php?id=<?php echo $row['id']?>"><button class="admin_edit_btn2" type="button">View details</button></a></td>
							</tr>
							<?php
							$j++;
						}
						?>
				</table>
			</div>
			</div>
		</div>
	</div>
</section>
<?php
	include 'office_footer.php';
?>