<?php 
	include '../db/connection.php';
	$id = $_POST['comp_id'];
	$feed = $_POST['feedback'];
	$status = 2;
	$sql = "update tbl_comp set feedback = '$feed',status='$status' where id = '$id'";
	$res = mysqli_query($conn,$sql);
	if($res){
		?>
		<script type="text/javascript">
			alert("Complaint feedback updated");
			window.location.href="complaints.php";
		</script>
		<?php
	}
?>