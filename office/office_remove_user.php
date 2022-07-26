<?php
	include '../db/connection.php';
	$user_id = $_GET['id'];
	$sql = "delete from tbl_user where u_id = '$user_id'";
	$res = mysqli_query($conn,$sql);
	$sql2 = "delete from tbl_login where type=1 and enter_id = '$user_id'";
	$res2 = mysqli_query($conn,$sql2);
	if($res){
		if($res2){
		?>
		<script type="text/javascript">
			alert("User Successfully Removed");
			window.location.href="office_user.php";
		</script>
		<?php
		}
	}

?>