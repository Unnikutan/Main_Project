<?php
	$make_nav=2;
	include '../db/connection.php';
	include '../controls/admin_controls.php';
	include 'admin_header.php';
	if(isset($_POST["submit"])){
		$mname = $_POST["name"];
		$mpc = $_POST["pc"];
		$pos = $_POST["position"];
		$mlocation = $_POST["loc"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$repass = $_POST["re-pass"];
		$res = gb_fetch_by_user($conn,$username);
		if (mysqli_num_rows($res)>0){
			$err_user = "* username already exist";
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					$(".admin_add_mnc").show();
				});
			</script>
			<?php
		}
		elseif ($password!=$repass) {
			$err_repass = "* Password does not match";
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					$(".admin_add_mnc").show();
				});
			</script>
			<?php
		}
		elseif (strlen($password)<7){
			$err_repass = "* Password too short";
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					$(".admin_add_mnc").show();
				});
			</script>
			<?php
		}
		else{
			$result = insert_to_gb($conn,$mname,$mpc,$pos,$mlocation,$username,$password);
			$res_resql = fetch_gb_id($conn);
			$row_resql = mysqli_fetch_array($res_resql);
			$enter_id = $row_resql['gb_id'];
			$type = 3;
			$result_qu=insert_to_login($conn,$username,$password,$type,$enter_id);
			$ls = update_office($conn,$enter_id,$mname);
			if ($result&&$result_qu&&$ls){
				if($result_qu)
				?>
				<script type="text/javascript">
					alert("\n\t Municipality Registered");
				</script>
				<?php
			} 
		}
	}
	if(!isset($err_user)){
		$err_user="";
	}
	if (!isset($err_pass)) {
		$err_pass="";
	}
	if(!isset($err_repass)){
		$err_repass="";
	}
?>
<section id="admin_content">
	<div class="container px-3">
	<div class="row">
		<div class="col-md-4">
			<button id ="admin_add_muni"class="admin_btn3">Add new office</button>
		</div>
	</div>
	<div class="row">
		<div class="admin_add_mnc">
			<form method="post" action="">
				<div class="admin_add_mnc_form">
					<div class="admin_mnc_span">
					<table>
						<tr>
							<td style="text-align:left">Select Office</td>
							<td style="text-align:left">
								<?php
									$s="select * from tbl_office where gb_id is NULL";
									$r = mysqli_query($conn,$s);
								?>
								<select class="admin_input_select" name="name" required>
									<?php
									while($ro = mysqli_fetch_array($r)){
										?>
										<option><?php echo $ro['name']?></option>
									<?php }
									?>
									
								</select>
							</td>
						</tr>
						<tr>
							<td style="text-align:left">Person in charge</td>
							<td style="text-align:left"><input class="admin_input" type="text" name="pc" required></td>
						</tr>
						<tr>
							<td style="text-align:left">Position in WM office</td>
							<td style="text-align:left"><input class="admin_input" type="text" name="position" required></td>
						</tr>
						<tr>
							<td style="text-align:left">Building Address</td>
							<td><textarea class="admin_input" rows="2" cols="22" name="loc" required></textarea></td>
						</tr>
					</table>
					</div>
					<div class="admin_mnc_span">
					<table>
						<tr>
							<td style="text-align:left">Username</td>
							<td style="text-align:left"><input class="admin_input" type="text" name="username" required><div id="user_error" class="admin_txt_red"><?php echo $err_user; ?></div></td>
						</tr>
						<tr>
							<td style="text-align:left">Password</td>
							<td style="text-align:left"><input class="admin_input" type="Password" name="password" required></td>
						</tr>
						<tr>
							<td style="text-align:left">Confirm Password</td>
							<td style="text-align:left"><input class="admin_input" type="Password" name="re-pass" required><div id="pass_word" class="admin_txt_red"><?php echo $err_repass; ?></div></td>
						</tr>
					</table>
					</div>
				</div>
				<div class="row">
					<div class="admin_mnc_btn">
						<button type="Reset">Reset</button>
						<button type="submit" name="submit">Submit</button>
						<button id="admin_back_btn1" type="button">Back</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="admin_mnc_head brd">
		Waste Management Offices
	</div>
	<div class="admin_mnc_details">
		<table>
			<tr>
				<th>No</th>
				<th class="wd">Name</th>
				<th class="wd">Location</th>
				<th>Number of bins </th>
				<th>Number of Workers</th>
			</tr>
			<?php
				$result2 = fetch_all_gb($conn);
				if(mysqli_num_rows($result2)>0){
				$i = 1;
				while($row1 = mysqli_fetch_array($result2)){
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><a href="admin_mnc_edit.php?id=<?php echo $row1['gb_id'];?>"><?php echo $row1['gb_name'];?></a></td>
				<td><?php echo $row1['address']; ?></td>
				<td><div class="cnr">
					<?php 
						echo $row1['total_bin'];
					?>
				</div></td>
				<td></td>
			</tr>
			<?php
			$i++;
			}
		}
		?>
		</table>
		<?php
		if(mysqli_num_rows($result2)==0){
			?>
			<div class="admin_no_data_align">No data</div>
			<?php
		}
		?>
	</div>
	</div>
</section>
<?php
	include 'admin_footer.php';
?>