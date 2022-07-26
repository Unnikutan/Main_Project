<?php
	include '../db/connection.php';
	$truck_no = $_GET['id'];
	$sql = "delete from tbl_truck where truck_no = '$truck_no'";
	$res = mysqli_query($conn,$sql);
	if($res){
		?>
		<script type="text/javascript">
			alert("Truck Removed");
			window.location.href="admin_truck.php";
		</script>
		<?php
	}
?>