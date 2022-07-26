<?php 
	include '../db/connection.php';
	$route_id = $_POST['route_id'];
	$date = $_POST['date'];
	$truck_no = $_POST['truck_select'];
	$sql = "UPDATE tbl_route SET truck_no = '$truck_no', day = '$date' WHERE route_id = '$route_id' ";
	$result = mysqli_query($conn,$sql);
	if ($result){
		?>
		<script type="text/javascript">
			alert("Successfully updated");
			window.location.href="route_home.php";
		</script>
	<?php
	}
	?>