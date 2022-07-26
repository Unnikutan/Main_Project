<?php 
	include '../db/connection.php';
	include 'driver_header.php';
    $dr_id = $_SESSION['driver_id'];
		$bin = $_GET['id'];
    $sql = "select * from tbl_bins where bin_id = '$bin'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);
    $status = $row['status'];
?>
<section id="office_content">
	<div class="container">
		<div class="row">
			<div class="view_align_center">
				<div class="col-md-8 office_bg_color_view shadow p-3 mb-5 rounded">
					<div class="office_txt_head_view">
  						Bin Monitoring
  					</div>
  					<div class="container">
              <?php 
                if($status==1){
                ?>
  						<div class="row">
  							<div class="col-md-3 col-sm-6 col_align_view">
            					<div class="progress blue">
                					<span class="progress-left">
                    					<span class="progress-bar"></span>
                					</span>
                					<span class="progress-right">
                    					<span class="progress-bar"></span>
                					</span>
               					 	<div class="progress-value">Half</div>
            					</div>
            				</div>
            					<div class="col-md-3 col-sm-6 col_align_view">
            						<img style="width: 150px" src="../assets/img/214356.svg">
        						</div>
        					</div>
  						</div>
              <?php
              }
              elseif ($status==2) {
                ?>
  						<div class="row">                     
                            <div class="col-md-3 col-sm-6 col_align_view">
            					<div class="progress yellow">
                					<span class="progress-left">
                    					<span class="progress-bar"></span>
                					</span>
                					<span class="progress-right">
                    					<span class="progress-bar"></span>
                					</span>
                					<div class="progress-value">Full</div>
            					</div>                                    
        					</div>
            				<div class="col-md-3 col-sm-6 col_align_view">
                                <img style="width: 150px" src="../assets/img/233863.png">
        					</div>   
        				</div>
                <?php 
                  }
                  else{
                  ?>
        				<div class="row">
        					<div class="col-md-3 col-sm-6 col_align_view">
           						<div class="progress green">
                					<span class="progress-left">
                    					<span class="progress-bar"></span>
                					</span>
                					<span class="progress-right2">
                    					<span class="progress-bar"></span>
                					</span>
                					<div class="progress-value">Empty</div>
           					 	</div>
        					</div>
        					<div class="col-md-3 col-sm-6 col_align_view">
                				<img style="width: 150px" src="../assets/img/animated-nominating-committee-clipart-18.jpg">
       						</div>
        				</div>
                <?php 
                  }
                  ?>
        				<div class="row row_view">
        					<table class="table">
	        					<tr>
		        					<td>Bin </td>
                      <td>:</td>
		        					<td><?php echo $row['b_name']?></td>
		        				</tr>
		        				<tr>
		        					<td>Address : </td>
                      <td>:</td>
		        					<td><?php echo $row['location']?></td>
		        				</tr>
		           				</table>	
	           				</div>
	           				<div class="view_align_center">
	           					<a href="view_bin.php"><BUTTON class="reg_btn">BACK</BUTTON></a>
	           				</div>
        				</div>
  					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php
	include 'office_footer.php';
?>