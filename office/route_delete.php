<?php
	include '../db/connection.php';
	$route_id = $_GET['id'];
	echo $route_id;
	$sql = "delete from tbl_route where route_id='$route_id'";
	$result = mysqli_query($conn,$sql);
	if($result){
		?>
		<script type="text/javascript">
			alert("Route Deleted");
			window.location.href="route_edit.php";
		</script>
		<?php
	}
?>