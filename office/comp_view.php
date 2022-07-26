<?php
	include 'office_header.php';
	
		$off_id=$_SESSION['off_id'];
		$id = $_GET['id'];
		$sql = "Select * from tbl_comp where id = '$id'";
		$res = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($res);
		$type_id = $row['enter_id'];
		$type = $row['type'];
		if ($type==2){
			$enter_type = "Driver";
			$sql_details = "select * from tbl_driver where id = '$type_id'";
			$res_details = mysqli_query($conn,$sql_details);
			$row_details = mysqli_fetch_array($res_details);
		}
		elseif($type==1){
			$enter_type = "User";
			$sql_details = "select * from tbl_user where u_id = '$type_id'";
			$res_details = mysqli_query($conn,$sql_details);
			$row_details = mysqli_fetch_array($res_details);
		}
?>
<section id="office_content">
	<div class="container">
		<div class="row">
			<div class="col-md-12 office_bg_color shadow p-3 mb-5 rounded">
				<div class="office_txt_head">
  					Compliant Details
  				</div>
  				<div class="container">
  					<div class="row">
  						<div class="col-md-6">
  							<div class="comp_dr">
  								<table>
	  								<tr>
	  									<td>Name</td>
	  									<td>:</td>
	  									<td><?php echo $row_details['name'] ?></td>
	  								</tr>
	  								<tr>
	  									<td>Address</td>
	  									<td>:</td>
	  									<td><?php echo $row_details['address'] ?></td>
	  								</tr>
	  								<tr>
	  									<td>Issue</td>
	  									<td>:</td>
	  									<td><?php echo $row['topic'] ?></td>
	  								</tr>
	  							</table>
  							</div>
  						</div>
  						<div class="col-md-6">
  							<div class="comp_dr">
	  							<table>
	  								<tr>
	  									<td>Type</td>
	  									<td>:</td>
	  									<td><?php echo $enter_type ?></td>
	  								</tr>
	  								<tr>
	  									<td>Phone Number</td>
	  									<td>:</td>
	  									<td><?php echo $row_details['phno'] ?></td>
	  								</tr>
	  								<tr>
	  									<td>Description</td>
	  									<td>:</td>
	  									<td><?php echo $row['descrip'] ?></td>
	  								</tr>
	  							</table> 
	  						</div>
  						</div>
  						<center>
  						<form method="post" action="comp_feeback.php">
  							<input type="text" name="comp_id" value="<?php echo $id?>" hidden>
  							<div class="col-md-6">
  								Give Feeback 
  								<textarea rows="4" cols="80" style="margin-left:-80px;" name="feedback"></textarea>
  								<button class="reg_btn">Submit</button>
  							</div>
  						</form>
  						</center>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
</section>

<?php
	include 'office_footer.php';
?>