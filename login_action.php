<?php
	include 'db/connection.php';
	include 'controls/admin_controls.php';
	if (isset($_POST['submit'])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$page = $_POST['page'];
		$result = check_login_credentials($conn,$username,$password);
		if (mysqli_num_rows($result)==1) {
		$row = mysqli_fetch_array($result);
			if ($row['type']==0){
				header("location:admin/index.php");
				$_SESSION['admin']=1;
			}
			elseif ($row['type']==1) {
				header("location:worker/index.php");
				$_SESSION['worker_id']=$row['enter_id'];
			}
			elseif ($row['type']==2) {
				header("location:driver/index.php");
				$_SESSION['driver_id']=$row['enter_id'];
			}
			elseif (($row['type']==3)){
				header("location:office/index.php");
				$_SESSION['off_id']=$row['enter_id'];
			}
			elseif (($row['type']==4))  {
				header("location:user/index.php");
				$_SESSION['user_id']=$row['enter_id'];
			}
			else{
				echo "Nothing happened";
			}
		}
		else{
			$err="* Invalid Username and Password";
			if($page==1){
				include 'user_login.php';
			}
			elseif($page == 2){
				include 'driver_login.php';
			}
			else{
				include 'office_login.php';
			}
			
		}
	}
	else{
		header("location:user_login.php");
	}
?>