<?php
    include '../db/connection.php';
    include '../controls/admin_controls.php';

    $day = date('w');

    $route = "update tbl_route set itr = 1 where day = '$day'";
    $query_route = mysqli_query($conn,$route);


    $spl = 1;
    $truck = "KL-25-Z-0000";
    $de = "Special Route";
    $name = "Special Route";
    $insert = "insert into tbl_route(route_name,truck_no,details,spl,day) values('$name','$truck','$de','$spl','$day');";
    $result = mysqli_query($conn,$insert);
	if($result){
		$sql2 = "select route_id from tbl_route order by route_id desc limit 1";
		$result2 = mysqli_query($conn,$sql2);
		$row = mysqli_fetch_array($result2);
		$route_id = $row['route_id'];
        $bin = "select * from tbl_bins where type='C' and status = 2";
        $query_bin = mysqli_query($conn,$bin);
        while($values = mysqli_fetch_array($query_bin)){
            $bin_id = $values['bin_id'];
			$sql3 = "insert into tbl_route_details(route_id,bins) values('$route_id','$bin_id')";
			$result3 = mysqli_query($conn,$sql3);
		}

	}


?>