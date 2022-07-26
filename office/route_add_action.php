<?php
	include '../db/connection.php';
	$name = $_SESSION['name'];
	$values = $_SESSION['route_value'];
	$de = $_SESSION['details'];
	$gb_id=$_SESSION['off_id'];
	$sql = "insert into tbl_route(route_name,details,gb_id) values('$name','$de','$gb_id');";
	$result = mysqli_query($conn,$sql);
	if($result){
		$sql2 = "select route_id from tbl_route order by route_id desc limit 1";
		$result2 = mysqli_query($conn,$sql2);
		$row = mysqli_fetch_array($result2);
		$route_id = $row['route_id'];
		foreach ($values as $i) {
			$sql3 = "insert into tbl_route_details(route_id,bins) values('$route_id','$i')";
			$result3 = mysqli_query($conn,$sql3);
		}
	}
	$_SESSION['name']=NULL;
	$_SESSION['route_value']=NULL;
	$_SESSION['details']=NULL;
	header("location:route_home.php");
?>