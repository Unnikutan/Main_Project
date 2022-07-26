<?php
	include '../db/connection.php';
	include '../controls/admin_controls.php';
	$dr_id = $_SESSION['driver_id'];
	$type = 2;
	$gb_name = $_POST['gb_name'];
	$descrip = $_POST['descrip'];
	$issue = $_POST['issue'];
	$status = 0;
	$res = insert_compliant($conn,$type,$dr_id,$gb_name,$issue,$descrip,$status);
	if ($res){
		$comp = fetch_last_comp($conn);
		$last_comp = mysqli_fetch_array($comp);
		$last_comp_id = $last_comp['id'];
		$res2 = insert_notification($conn,3,$gb_name,'Complaint','Complaint from worker',$last_comp_id);
		if ($res2){
			?>
			<script type="text/javascript">
				alert("Compliant Successfully Submitted");
				window.location.href="complaints.php";
			</script>
		<?php
	}
	}	
?>