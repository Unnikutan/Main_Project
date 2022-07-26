<?php
	include '../db/connection.php';
	$bin_id = $_GET['id'];
	$sql = "delete from tbl_bins where bin_id = '$bin_id'";
	$res = mysqli_query($conn,$sql);
	if($res){
		?>
		<script type="text/javascript">
			alert("Bin deleted successfuly");
			window.location.href="view_bin.php";
		</script>
		<?php
	}
?>