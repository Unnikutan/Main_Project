<?php 
	$make_nav=1;
	include '../db/connection.php';
	include '../controls/admin_controls.php';
	include 'admin_header.php';

	$bin = fetch_bin($conn); 
	?>

<section id="admin_content">
	<div class="container px-5">
		<div class="row mb-3">
			<div class="col">
				<span class="admin_dashboard-text">Dashboard</span>
			</div>
		</div>
		<div class="row w-100">
			<div class="col-md-3">
				<div class="card shadow admin-bg01">
					<div class="card-body">
						<table class="admin_dashboard-table">
							<tr>
								<td class="admin_dashboard-td01">
									<?php
										$office = fetch_all_gb($conn);
										echo mysqli_num_rows($office);
									?>
								</td>
								<td class="admin_dashboard-td2-01 admin_dash_t-r"> <i class="ba bi-building" ></i> </td>
							</tr>
						</table>
						<div class="admin_dashboard_card_footer-text admin-bg01" style="color:aliceblue;">
							Total Offices
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card shadow admin-bg03">
					<div class="card-body">
						<table class="admin_dashboard-table">
							<tr>
								<td class="admin_dashboard-td2-01">
									<?php 
										$bins = fetch_bin($conn);
										echo mysqli_num_rows($bins);
									?>
								</td>
								<td class="admin_dashboard-td2-01 admin_dash_t-r"> <i class="ba bi-trash" ></i> </td>
							</tr>
						</table>
						<div class="admin_dashboard_card_footer-text admin-bg03" style="color:black;">
							Total Bins Used
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card shadow admin-bg05">
					<div class="card-body">
						<table class="admin_dashboard-table">
							<tr>
								<td class="admin_dashboard-td2-01">
									<?php 
										$drivers = fetch_all_drivers($conn);
										echo mysqli_num_rows($drivers);
									?> 
								</td>
								<td class="admin_dashboard-td2-01 admin_dash_t-r"> <i class="ba bi-person-badge" ></i> </td>
							</tr>
						</table>
						<div class="admin_dashboard_card_footer-text admin-bg05" style="color:black;">
							Total workers
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card shadow admin-bg07">
					<div class="card-body">
						<table class="admin_dashboard-table">
							<tr>
								<td class="admin_dashboard-td2-01">
									<?php
										$user = fetch_all_users($conn);
										echo mysqli_num_rows($user);
									?>
								</td>
								<td class="admin_dashboard-td2-01 admin_dash_t-r"> <i class="ba bi-person-fill" ></i> </td>
							</tr>
						</table>
						<div class="admin_dashboard_card_footer-text admin-bg07" style="color:black;">
							Total Users
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
		$total_bin = 0;
		$small_bin_left = 0;
		$large_bin_left = 0;
		$con_left = 0;
			while($read = mysqli_fetch_array($office)){
				$total_bin = $total_bin + $read['total_bin'];
				$small_bin_left = $small_bin_left + $read['small_bin'];
				$large_bin_left = $large_bin_left + $read['large_bin'];
				$con_left = $con_left + $read['container'];
			}
		?>
		<div class="row" style="margin: 40px 20px 20px 20px;">
			<div class="col-sm-6">
				<div id="office_map">

				</div>
			</div>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-12 office_bg_color shadow p-3 mb-5 rounded">
						<div class="office_txt_head">
							Bins Overview
						</div>
										<div class="card-text mt-3  text-center">
											<table style="width: 100%;">
												<tr>
													<th class=" py-3 pr-2" colspan="2"> Total Bins </th>
													<th colspan="2" class="py-3"><?php echo $total_bin ?></th>
												</tr>
												<tr class="bg-dark" style="color: white;">
													<th class="p-1"> Bins </th>
													<th class="p-1"> Assigned </th>
													<th class="p-1"> Used </th>
													<th class="p-1"> Not Used </th>
												</tr>
												<tr>
													<?php
														$small_bin = fetch_bin_by_type_wm($conn,0,"S");
														$small_count = mysqli_num_rows($small_bin); 
													?>
													<td class="text-left p-1 pr-2"> Small Bins </td>
													<td> <?php echo $small_count + $small_bin_left ?> </td>
													<td> <?php echo $small_count ?></td>
													<td> <?php echo $small_bin_left ?></td>
												</tr>
												<tr>
												<?php
														$large_bin = fetch_bin_by_type_wm($conn,0,"L");
														$large_count = mysqli_num_rows($large_bin); 
													?>
													<td class="text-left p-1"> Large Bins </td>
													<td> <?php echo $large_count + $large_bin_left ?></td>
													<td> <?php echo $large_count ?> </td>
													<td>  <?php echo $large_bin_left ?></td>
												</tr>
												<tr>
												<?php
														$con_bin = fetch_bin_by_type_wm($conn,0,"C");
														$con_count = mysqli_num_rows($con_bin); 
													?>
													<td class="text-left p-1"> Container Bins </td>
													<td> <?php echo $con_count + $con_left ?> </td>
													<td> <?php echo $con_count ?></td>
													<td>  <?php echo $con_left ?></td>
												</tr>
											</table>
										</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
</section>
<script type="text/javascript">

        function myMap() {
            var mapOptions = {
                center: new google.maps.LatLng(8.968178519055327, 76.99164701629496),
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            var map = new google.maps.Map(document.getElementById("office_map"), mapOptions);

            
            //google.maps.event.addListener(map, 'click', function (e) {
                //alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
                //document.getElementById("la").value=e.latLng.lat();
                //document.getElementById("lo").value=e.latLng.lng();
            //});
        }
  
  </script>


	<?php
	include 'admin_footer.php';
	?>
