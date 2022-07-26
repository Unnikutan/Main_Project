<?php
	include 'office_header.php';
	$off_id = $_SESSION['off_id'];
?>
	<div class="admin_user_block">
		<div class="admin_user_head">
			<div class="admin_user_head_span1">
				Workers
			</div>
			<div class="admin_user_head_span2">
				<input type="text" name="search" id="search" onkeyup="myfuntion()" class="admin_user_search_input" placeholder="Search"><button type="button" class="admin_user_btn_search"><i class="bi-search admin_user_btn_icon"></i></button>
			</div>
		</div>
		<div class="admin_user_display" id="admin_user_display">
			<?php
				$res = fetch_driver_by_gb($conn,$off_id);
				if (mysqli_num_rows($res)>0){
				while($row=mysqli_fetch_array($res)){
			?>
			<a href="worker_details.php?id=<?php echo $row['id']; ?>"><div class="admin_user_each" id="admin_user_each"> 
				<div class="admin_user_each_img"></div>
					<div class="admin_user_each_details">
						<div class="admin_user_txt" name="admin_user_name"><b><?php echo $row['name']; ?></b></div>
						<div class="admin_user_txt2">Age : <?php echo $row['age'];?></div>
                        <div class="admin_user_txt2">Job : <?php 
																if($row['type']==1)
																	echo "Walking Garbage Collector";
																else
																	echo "Driver";
																	?></div>
					</div>
				</div>
			</a>
			<?php
			}
			}
			else{
				echo "No Registered Workers";
			}
			?>
		</div>
	</div>
<?php 	
	include 'office_footer.php'; 
?>