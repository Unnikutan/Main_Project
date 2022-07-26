<?php
	include '../db/connection.php';
	include 'driver_header.php';
	if(!isset($_SESSION['driver_id'])){
		header("location:../driver_login.php");
	}
	else{
		$dr_id = $_SESSION['driver_id'];
		$id = $_GET['id'];
		$sql = "select * from tbl_comp where id='$id'";
		$res = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($res);

?>
	<div class="container mt-5 pt-5">
		<div class="row">
			<div class="col-md-12 shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					Feedback
  				</div>
  				<div class="feed_view_table">
				<table>
					<tr>
						<td>Complaint Type</td>
						<td>:</td>
						<td><?php echo $row['topic']?></td>
					</tr>
					<tr>
						<td>Description</td>
						<td>:</td>
						<td><?php echo $row['descrip']?></td>
					</tr>
					<tr>
						<td>Feedback</td>
						<td>:</td>
						<td><?php echo $row['feedback']?></td>
					</tr>
				</table>
				<a href="complaints.php"><button class="reg_btn" type="button">Back</button></a>
				</div>
				
			</div>
		</div>
	</div>
</div>

<?php
	}
	include 'driver_footer.php';
?>