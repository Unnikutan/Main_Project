<?php
	include 'office_header.php';
	$off_id = $_SESSION['off_id'];
?>
	<div class="admin_user_block">
		<div class="admin_user_head">
			<div class="admin_user_head_span1">
				All Users
			</div>
			<div class="admin_user_head_span2">
				<input type="text" name="search" id="search" onkeyup="myfuntion()" class="admin_user_search_input" placeholder="Search"><button type="button" class="admin_user_btn_search"><i class="bi-search admin_user_btn_icon"></i></button>
			</div>
		</div>
		<div class="admin_user_display" id="admin_user_display">
			<?php
				$sql = "select * from tbl_user t1 inner join tbl_gb t2 on t1.gb_id = t2.gb_id where t2.gb_id ='$off_id'";
				$res = mysqli_query($conn,$sql);
				if (mysqli_num_rows($res)>0){
				while($row=mysqli_fetch_array($res)){
			?>
			<a href="office_user_edit.php?id=<?php echo $row['u_id']; ?>"><div class="admin_user_each" id="admin_user_each"> 
				<div class="admin_user_each_img"></div>
					<div class="admin_user_each_details">
						<div class="admin_user_txt" name="admin_user_name"><b><?php echo $row['name']; ?></b></div>
						<div class="admin_user_txt2">Age : <?php echo $row['age'];?></div>
						<div class="admin_user_txt2"> Office : <?php echo $row['gb_name'];?></div>
					</div>
				</div>
			</a>
			<?php
			}
			}
			else{
				echo "No Registered User";
			}
			?>
		</div>
	</div>
<?php 	
	include 'office_footer.php'; 
?>
