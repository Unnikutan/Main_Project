<?php
	include '../db/connection.php';
	$id = $_GET['id'];
	$sql = "delete from tbl_gb where gb_id = '$id' ";
	$res = mysqli_query($conn,$sql);
	$sql2 = "delete from tbl_login where type=3 and enter_id = '$id'";
	$res2 = mysqli_query($conn,$sql2);
	if (!$res){
		?>
		<script type="text/javascript">
			alert("\n\t Technical Error");
		</script>
		<?php
	}
	else{
		?>
		<script type="text/javascript">
			alert("\n\t Office details Successfully removed");
			window.location.href="admin_mnc_edit.php";
		</script>
		<?php
	}
?>