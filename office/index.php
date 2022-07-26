<?php
  include 'office_header.php';
  $off_id = $_SESSION['off_id'];
  $sql1 = "Select * from tbl_gb where gb_id = '$off_id'";
  $res1 = mysqli_query($conn,$sql1);
  $row1 = mysqli_fetch_array($res1);
?>
<div class="container p-0">
	<div class="row m-3 mt-5">
  	<div class="col-sm-3">
   		<div class="card shadow p-3 mb-5 rounded">
    	<div class="card-body">
    		<div class="office_col_head"><i class="bi-trash2-fill"></i></div>
        	<h5 class="card-title">Bins</h5>
        	<p class="card-text office_center">
            <?php 
              echo $row1['total_bin'];
            ?>
          </p>
      	</div>
    	</div>
  	</div>
  	<div class="col-sm-3">
   		<div class="card shadow p-3 mb-5 rounded">
    	<div class="card-body">
    		<div class="office_col_head2"><i class="bi-person-fill"></i></div>
        	<h5 class="card-title">Users</h5>
        	<p class="card-text office_center">
            <?php 
              $sql_user="select * from tbl_user where gb_id = '$off_id'";
              $res_user = mysqli_query($conn,$sql_user);
              $row_user = mysqli_num_rows($res_user);
              echo $row_user;
            ?>
          </p>
      	</div>
    	</div>
  	</div>
  	<div class="col-sm-3">
   		<div class="card shadow p-3 mb-5 rounded">
    	<div class="card-body">
    		<div class="office_col_head3"><i class="bi-truck"></i></div>
        	<h5 class="card-title">Trucks</h5>
        	<p class="card-text office_center">
            <?php 
              $sql2="select * from tbl_truck where gb_id = '$off_id'";
              $res2 = mysqli_query($conn,$sql2);
              $row2 = mysqli_num_rows($res2);
              echo $row2;
            ?>
          </p>
      	</div>
    	</div>
  	</div>
  	<div class="col-sm-3">
   		<div class="card shadow p-3 mb-5 rounded">
    	<div class="card-body">
    		<div class="office_col_head4"><i class="bi-exclamation-circle-fill"></i></div>
        	<h5 class="card-title">Complaint</h5>
        	<p class="card-text office_center">
           <?php 
              $sql2="select * from tbl_comp where gb_id = '$off_id'";
              $res2 = mysqli_query($conn,$sql2);
              $row2 = mysqli_num_rows($res2);
              echo $row2;
            ?> 
          </p>
      	</div>
    	</div>
  	</div>
  	</div>
  		<div class="row m-3">
  			<div class="col-md-7 office_bg_color shadow p-3 mb-5 rounded">
  				<div class="office_txt_head">
  					Bins Overview
  				</div>
          <div class="card-text mt-3  text-center">
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
													$small_bin = fetch_bin_by_type_wm($conn,$off_id,"S");
													$small_count = mysqli_num_rows($small_bin); 
												?>
												<td class="text-left p-1 pr-2"> Small Bins </td>
												<td> <?php echo $small_count + $row1['small_bin']; ?> </td>
												<td> <?php echo $small_count ?></td>
												<td> <?php echo $row1['small_bin'] ?></td>
											</tr>
											<tr>
											<?php
													$large_bin = fetch_bin_by_type_wm($conn,$off_id,"L");
													$large_count = mysqli_num_rows($large_bin); 
												?>
												<td class="text-left p-1"> Large Bins </td>
												<td> <?php echo $large_count + $row1['large_bin']; ?></td>
												<td> <?php echo $large_count ?> </td>
												<td>  <?php echo $row1['large_bin'] ?></td>
											</tr>
											<tr>
											<?php
													$con_bin = fetch_bin_by_type_wm($conn,$off_id,"C");
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
  			<div class="col-md-5">
  				<div id="office_map">
  				</div>
  			</div>
  		</div>
  	</div>
</div>
	<script type="text/javascript">
    <?php 
      $sql="Select * from tbl_office where gb_id = '$off_id'";
      $res = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($res);
    ?>
        function myMap() {
            var mapOptions = {
                center: new google.maps.LatLng(<?php echo $row['lat']?>,<?php echo $row['lon']?>),
                zoom: 13,
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
	include 'office_footer.php';
?>