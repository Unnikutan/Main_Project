<?php
	include '../db/connection.php';
	include 'user_header.php';
	if(!isset($_SESSION['user_id'])){
		header("location:../user_login.php");
	}
	else{
		$dr_id = $_SESSION['user_id'];
		$id = $_GET['id'];
		$sql = "select * from tbl_comp where id='$id'";
		$res = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($res);

?>
<section id="office_content">
	<div class="container">
		<div class="row">
			<div class="col-md-12 driver_bg_12 shadow p-3 mb-5 rounded">
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
</section>
<?php
	}
	include 'user_footer.php';
?>