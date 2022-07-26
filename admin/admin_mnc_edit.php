<?php
	$make_nav=2;
	include '../db/connection.php';
	include 'admin_header.php';
	include '../controls/admin_controls.php';
	if(isset($_POST['admin_gb_save'])){
		$id = $_SESSION['id'];
		$mpc = $_POST["pc"];
		//$pos = $_POST["position"];
		$mlocation = $_POST["loc"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql2 = " update tbl_gb set person='$mpc',address='$mlocation',username='$username',password='$password'";
		$result = mysqli_query($conn,$sql2);
		if ($result){
			?>
			<script type="text/javascript">
				alert("Successfully updated");
			</script>
			<?php
		}
	}
	if ($_SERVER['REQUEST_METHOD']==='GET'){
		if(isset($_GET['id'])){
		$gb_id = $_GET['id'];
		}
	}
	else{
		if(isset($_POST['off_submit'])){
			$gb_id = $_POST['select_office'];

		}
	}
	?>
<div id="admin_municipality_content">
	<div class="admin_edit_sel">
		<form method="post" action="">
		<table>
			<tr>
				<td><div div class="admin_edit_txt">Select Office </div></td>
				<td style="width: 50%;">
					<select class="admin_input_select" name="select_office">
						<?php
							$res = fetch_all_gb($conn);
							while($row=mysqli_fetch_array($res)){
						?>
						<option value="<?php echo $row['gb_id']; ?>"><?php echo $row['gb_name']; ?></option>
						<?php
							}
						?>
					</select>
				</td>
				<td> <button type="submit" class="admin_first_sub" id="admin_edit_submit" name="off_submit">Submit</button></td>
			</tr>
		</table>
		</form>
	</div>
<?php
	if(isset($gb_id)){
		$_SESSION['id']=$gb_id;
	 ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".admin_edit_content").show();
			});
		</script>
		<?php
		$res1 = fetch_gb_by_id($conn,$gb_id);
		$row1 = mysqli_fetch_array($res1);
?>

	<div class="admin_edit_content">
		<div class="container">
			<div class="row p-2">
				<div class="col-sm-6">
					<div class="admin_head_text">
						<?php echo $row1['gb_name']; ?>	WM Station
					</div>
				</div>
				<div class="col-sm-6">
				<a href="admin_off_remove.php?id=<?php echo $row1['gb_id']; ?>"><button class="admin_edit_btn2 admin_icon_span_right" id="admin_edit_remove"> <i class="bi-trash-fill"></i> remove office</button></a>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-sm-8" style="align-content: center;">
					<div class="row">
						<div class="col-sm-8">
							<div class="card shadow p-3 mb-5 rounded">
								<div class="card-body mb-4">
									<div class="office_col_head"><i class="bi-trash2-fill"></i></div>
									<h5 class="card-title">Bins</h5>
									<div class="card-text mt-3">
										<table style="width: 100%;">
											<tr>
												<th class=" py-3 pr-2" colspan="2"> Total Bins </th>
												<th colspan="2" class="py-3"><?php echo $row1['total_bin'] ?></th>
											</tr>
											<tr class="bg-dark" style="color: white;">
												<th class="p-1"> Bins </th>
												<th class="p-1"> Given </th>
												<th class="p-1"> Used </th>
												<th class="p-1"> Balance </th>
											</tr>
											<tr>
												<?php
													$small_bin = fetch_bin_by_type_wm($conn,$gb_id,"S");
													$small_count = mysqli_num_rows($small_bin); 
												?>
												<td class="text-left p-1 pr-2"> Small Bins </td>
												<td> <?php echo $small_count + $row1['small_bin']; ?> </td>
												<td> <?php echo $small_count ?></td>
												<td> <?php echo $row1['small_bin'] ?></td>
											</tr>
											<tr>
											<?php
													$large_bin = fetch_bin_by_type_wm($conn,$gb_id,"L");
													$large_count = mysqli_num_rows($large_bin); 
												?>
												<td class="text-left p-1"> Large Bins </td>
												<td> <?php echo $large_count + $row1['large_bin']; ?></td>
												<td> <?php echo $large_count ?> </td>
												<td>  <?php echo $row1['large_bin'] ?></td>
											</tr>
											<tr>
											<?php
													$con_bin = fetch_bin_by_type_wm($conn,$gb_id,"C");
													$con_count = mysqli_num_rows($con_bin); 
												?>
												<td class="text-left p-1"> Container Bins </td>
												<td> <?php echo $con_count + $row1['container']; ?> </td>
												<td> <?php echo $con_count ?></td>
												<td>  <?php echo $row1['container'] ?></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="row">
								<div class="col-sm-12">
									<div class="card shadow p-3 mb-5 rounded">
										<div class="card-body">
										<div class="office_col_head3"><i class="bi-person-fill"></i></div>
											<h5 class="card-title">Users</h5>
											<div class="card-text mt-3">
												<table style="width: 100%;">
													<tr>
														<td class="text-left p-1"> Total Users </td>
														<td> <?php
															$user = select_user_by_gb($conn,$gb_id);
															echo mysqli_num_rows($user); 
															?> 
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
								<div class="card shadow p-3 mb-5 rounded">
									<div class="card-body">
										<div class="office_col_head3"><i class="bi-truck"></i></div>
											<h5 class="card-title">Vehicles</h5>
											<div class="card-text mt-3">
												<table style="width: 100%;">
													<tr>
														<td class="text-left p-1"> Total  </td>
														<td> 
															<?php
																$truck = fetch_truck_by_gb($conn,$gb_id);
																echo mysqli_num_rows($truck);
															?>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-5">
							<div class="card shadow p-3 mb-5 rounded">
								<div class="card-body">
								<div class="office_col_head3"><i class="bi-person-fill"></i></div>
        							<h5 class="card-title">Workers</h5>
									<div class="card-text mt-3">
										<table style="width: 100%;">
											<tr>
												<td class="text-left p-1"> Total Workers  </td>
												<td><?php  
														$workers = fetch_driver_by_gb($conn,$gb_id);
														echo mysqli_num_rows($workers);
													?>
												</td>
											</tr>
											<tr>
												<td class="text-left p-1"> Garbage Collectors  </td>
												<td> 
												<?php  
														$workers = fetch_drivers_by_type_gb($conn,1,$gb_id);
														echo mysqli_num_rows($workers);
													?>
												</td>
											</tr>
											<tr>
												<td class="text-left p-1"> Drivers  </td>
												<td> 
													<?php  
														$workers = fetch_drivers_by_type_gb($conn,2,$gb_id);
														echo mysqli_num_rows($workers);
													?>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="card shadow p-3 mb-5 rounded">
								<div class="card-body">
								<div class="office_col_head"><i class="bi-exclamation-circle-fill"></i></div>
        							<h5 class="card-title">Complaint</h5>
									<div class="card-text mt-3">
										<table style="width: 100%;">
											<tr>
												<td class="text-left p-1"> Total Complaints   </td>
												<td> 
													<?php
														$t_comp = fetch_comp_by_gb_id($conn,$gb_id);
														echo mysqli_num_rows($t_comp);
													?>
												</td>
											</tr>
											<tr>
												<td class="text-left p-1"> Solved  </td>
												<td>  
													<?php
														$s_comp = fetch_comp_by_type_gb($conn,2,$gb_id);
														echo mysqli_num_rows($s_comp);
													?>
												</td>
											</tr>
											<tr>
												<td class="text-left p-1"> Pending  </td>
												<td>  
													<?php
														$p_comp = fetch_comp_by_type_gb($conn,0,$gb_id);
														echo mysqli_num_rows($p_comp);
													?>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="col-sm-4 shadow mb-3 pb-3">
					<div class="admin_add_mnc_form">
						<div class="admin_edit_align_right"><h4 style="text-align: left; float:left;">Details</h4><button class="admin_edit_btn2" id="admin_edit_editbtn"><i class="bi-pencil-square"></i>&nbsp;edit</button></div>
						<form id="myform" method="post" action="">
							<table style="margin-top:25px">
								<tr>
									<td class="textleft">Person in charge</td>
									<td><input type="text" name="pc" value="<?php echo $row1['person']; ?>" disabled></td>
								</tr>
								<tr>
									<td class="text-left">Username</td>
									<td><input type="text" name="username" value="<?php echo $row1['username']; ?>" disabled></td>
								</tr>
								<tr>
									<td class="text-left">Password</td>
									<td><input type="text" name="password" value="<?php echo $row1['password']; ?>" disabled></td>
								</tr>
								<tr>
									<td class="text-left">Location</td>
									<td><textarea name="loc" rows="5" cols="20" disabled><?php echo $row1['address']; ?></textarea></td>
								</tr>
							</table>
						<div>
							<button type="submit" class="admin_edit_btn" name="admin_gb_save" id="admin_gb_save" disabled>Save Changes</button>
							<button type="reset" class="admin_edit_btn_5">Cancel</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	
	</div>
	<?php
	}
	?>
</div>

<?php include 'admin_footer.php'; ?>