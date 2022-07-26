<?php
    include 'office_header.php';
    $off_id = $_SESSION['off_id'];
    if (isset($_POST['submit'])){
        $bin = $_POST['bin'];
        $num = $_POST['num'];
        $res = insert_to_request($conn,$off_id,$bin,$num);
        if($res){
            $office = fetch_gb_by_id($conn,$off_id);
            $office_dts = mysqli_fetch_array($office);
            $office_name = "New bin request from ".$office_dts['gb_name']." Office";
            $req = fetch_last_request($conn);
            $req_dts = mysqli_fetch_array($req);
            $req_id = $req_dts['id'];
            $res2 = insert_notification($conn,0,100,'Request Bin',$office_name,10);
            ?>
            <script>
                alert("Request added successfully");
            </script>
            <?php
        }
    }
?>

<div class="container mt-3">
	<div class="admin_row_2">
		<button id ="admin_add_muni"class="admin_btn3">Add new request</button>
	</div>
	<div class="admin_add_truck bg-transparent h-auto">
		<form method="post" action="">
			<div class="admin_add_mnc_form">
				<table>
					<tr>
						<td>Select bin type</td>
						<td>
							<select class="admin_input_select" name="bin" required>
								<option> --Select--</option>	
                                <option value='S'>Small Bin</option>
                                <option value='L'>Large Bin</option>
                                <option value='C'>Container</option>
							</select>
						</td>
					</tr>
                    <tr>
                        <td> Number of bins </td>
                        <td> <input type="number" name="num"></td>
                    </tr>
				</table>
				<div class="admin_mnc_btn">
					<button type="submit" name="submit" class="login_btn2">Submit</button>
					<button id="admin_back_btn1" type="button" class="login_btn2">Back</button>
				</div>
			</div>
		</form>
	</div>
	<div class="admin_mnc_head brd">
		Previous Request 
	</div>
	<div class="admin_mnc_details">
		<table>
			<tr>
				<th>#</th>
                <th>Date</th>
				<th>Bin Type</th>
				<th>Number of Bins</th>
				<th>Status</th>
				<th>Comment</th>
			</tr>
            <?php
                $res = fetch_request_by_id($conn,$off_id);
                $i = 0;
                while($row = mysqli_fetch_array($res)){
                    $i++;
                   ?> 
                   <tr>
                        <td> <?php echo $i ?></td>
                        <td> <?php echo $row['date']; ?></td>
                        <td> <?php 
                                if(!strcmp($row['type'],"S")){
                                    echo "Small bin";
                                } 
                                elseif(!strcmp($row['type'],"L")){
                                    echo "Large bin";
                                }
                                elseif(!strcmp($row['type'],"C")){
                                    echo "Container Bin";
                                }
                            ?>
                        </td>
                        <td> <?php echo $row['num']; ?></td>
                        <td> <?php 
                                if($row['status']==0){
                                    echo "Pending";
                                }
                                elseif($row['status']==1){
                                    echo "Approved";
                                }
                                else{
                                    echo "Rejected";
                                }
                            ?>
                        </td>
                        <td> <?php echo $row['comment']; ?></td>
                   </tr>
                   <?php
                }
            ?>
        </table>
    </div>
</div>

<?php
    include 'office_footer.php';
?>