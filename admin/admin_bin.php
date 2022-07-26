<?php
    $make_nav = 5;
    include '../db/connection.php';
    include '../controls/admin_controls.php';
    include 'admin_header.php';
    $res;
    $cen;
    if(isset($_POST['submit'])){
        $type = $_POST['bin'];
        $gb = $_POST['wm'];
        $get_data=1;
        $cen = array('lat'=> 8.962230342060213,"lon" => "76.98815772624036");
        
    }
    else{
        $get_data=2;
        $cen = array('lat'=> 8.962230342060213,"lon" => "76.98815772624036");
    }
    $bin_request = select_request($conn);
    $read_request_count = mysqli_num_rows($bin_request);
?>
    <div class="container mt-3">
        <div class="admin_row_2">
            <button id ="admin_add_muni"class="admin_btn3"> Bin Request 
                <?php 
                    if($read_request_count>0){
                ?>
                <span class="badge bg-danger mx-2 rounded-3">
                    <?php
                        echo $read_request_count;
                    ?>
                </span> 
                <?php
                    }
                ?>
            </button>
        </div>
        <div class="admin_add_truck" style="background-color: #fff; overflow:auto">
                <div class="admin_add_mnc_form">
                    <?php 
                    if($read_request_count>0){
                    ?>
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-dark">
                            <th scope="col">#</th>
                            <th scope="col">WM Station</th>
                            <th scope="col">Bin Type</th>
                            <th scope="col">Number</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $req = 0;
                            $bin_request = select_request($conn);
                            while($read_request = mysqli_fetch_array($bin_request)){
                                $req++;
                            ?>
                            <tr>
                                <th scope="row"> <?php echo $req ?> </th>
                                <td>
                                    <?php 
                                        $gb_id = $read_request['gb_id'];
                                        $sql_gbname = fetch_gb_by_id($conn,$gb_id);
                                        $gb_name = mysqli_fetch_array($sql_gbname);
                                        echo $gb_name['gb_name'];
                                    ?> 
                                </td>
                                <td>
                                    <?php
                                        if(!strcmp($read_request['type'],"S")){
                                            echo "Small Bin";
                                        }
                                        elseif(!strcmp($read_request['type'],"L")){
                                            echo "Large Bin";
                                        }
                                        elseif(!strcmp($read_request['type'],"C")){
                                            echo "Container Bin";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $read_request['num'] ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#approveModal<?php echo $req ?>">Appprove</button>
                                    <button type="button" class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#rejectModal<?php echo $req ?>">Reject</button>
                                </td>
                            </tr>
                                <!-- Approve Modal -->
                            
                                <div class="modal fade" id="approveModal<?php echo $req ?>" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <form method="post" action="admin_request_action.php">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-6">WM Office</div>
                                                <div class="col-md-6 ms-auto">
                                                    <input type="text" class="form-control" value="<?php echo $gb_name['gb_name'] ?>" disabled>
                                                    <input type="text" class="form-control" name="request_gb" value="<?php echo $read_request['gb_id'] ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Bin Type </div>
                                                <div class="col-md-6 ms-auto">
                                                    <input type="text" class="form-control" value="<?php if(!strcmp($read_request['type'],"S")){
                                                                                                        echo "Small Bin";
                                                                                                    }
                                                                                                    elseif(!strcmp($read_request['type'],"L")){
                                                                                                        echo "Large Bin";
                                                                                                    }
                                                                                                    elseif(!strcmp($read_request['type'],"C")){
                                                                                                        echo "Container Bin";
                                                                                                    } ?>" disabled>
                                                    <input type="text" class="form-control" name="request_type" value="<?php echo $read_request['type'] ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Bins</div>
                                                <div class="col-md-6 ms-auto">
                                                    <input type="text" class="form-control" name="request_amount" value="<?php echo $read_request['num'] ?>">
                                                    <input type="text" class="form-control" name="request_id" value="<?php echo $read_request['id'] ?>" hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="approve_submit">Save changes</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                                </div>
                                <!-- Approve Modal -->
                                <div class="modal fade" id="rejectModal<?php echo $req ?>" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                <form method="post" action="admin_request_action.php">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reason for Rejection</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-6">WM Office</div>
                                                <div class="col-md-6 ms-auto">
                                                    <input type="text" class="form-control" value="<?php echo $gb_name['gb_name'] ?>" disabled>
                                                    <input type="text" class="form-control" name="request_gb" value="<?php echo $read_request['gb_id'] ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Bins</div>
                                                <div class="col-md-6 ms-auto">
                                                    <input type="text" class="form-control" value="<?php echo $read_request['num'] ?>" disabled>
                                                    <input type="text" class="form-control" name="request_id" value="<?php echo $read_request['id'] ?>" hidden>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Reason</div>
                                                <div class="col-md-6 ms-auto">
                                                    <textarea rows="2" cols="5" name="request_reason" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="reject_submit">Reject</button>
                                    </div>
                                    </div>
                                </div>
                                </form>
                                </div>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    }
                    else{
                        echo "No Request";
                    }
                    ?>
                </div>
        </div>
        <form method="post" action="">
        <div class="row">
            <div class="admin_mnc_head brd">
	        	Bins
	        </div>
        </div>
        <div class="row m-3">
            <div class="col w-100 text-center">
                Bin :   <select class="p-1 mx-3" name="bin">
                            <option value="All">All</option>
                            <option value='S'>Small Bin</option>
                            <option value="L">Large Bin</option>
                            <option value="C">Container</option>
                        </select>
                WM :    <select class="p-1 mx-3" name="wm">
                            <?php 
                                $res = fetch_all_gb($conn);
                            ?>
                            <option value=0>All</option>
                            <?php 
                                while($row=mysqli_fetch_array($res)){
                                    ?>
                            <option value="<?php echo $row['gb_id']; ?>"> <?php echo $row['gb_name']; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                <button class="btn btn-primary" style="font-size: 14px; padding:5px 10px;" name="submit"> add filter</button>
            </div>
        </div>
        </form>

        <div class="row border-top p-3">
            <div class="col-sm-6">
                <div id="map_1" style="height: 50vh; border:1px solid black;">

                </div>
            </div>
            <div class="d-flex flex-column col-sm-6 shadow p-0">
                <div class="text-center p-2 border " style="background-color: #ddd;">
                    Small Bin : <img src="../assets/img/small_green.ico" width="50px" height="50px">
                    Large Bin : <img src="../assets/img/large_green.ico" width="50px" height="50px">
                    Container : <img src="../assets/img/Con_green.ico" width="50px" height="50px">
                </div>
                <div class="d-flex justify-content-center mt-2">
                <table class="w-50 mt-4">
                    <tbody class="admin_bin_align">
                        <tr>
                            <th class="text-left" style="font-size: 18px; padding:10px;">Total Bins</th>
                            <th style="font-size: 18px; padding:10px;"> <?php 
                                    if($get_data==1){
                                        $res = fetch_bin_by_type_wm($conn,$gb,$type);
                                    }
                                    else{
                                        $res = fetch_bin($conn);
                                    }
                                    $dis_row = mysqli_num_rows($res);
                                    echo $dis_row;
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <td class="text-left" style="font-size: 18px; padding:10px;">Full Loaded Bins</td>
                            <td style="font-size: 18px; padding:10px;"><?php
                                    $count = 0;
                                    if($get_data==1){
                                        $res = fetch_bin_by_type_wm($conn,$gb,$type);
                                    }
                                    else{
                                        $res = fetch_bin($conn);
                                    }
                                    while($dis_row=mysqli_fetch_array($res)){
                                        if($dis_row['status']==2){
                                            $count++;
                                        }
                                    }
                                    echo $count;
                                ?> 
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="font-size: 18px; padding:10px;">Half Loaded Bins</td>
                            <td style="font-size: 18px; padding:10px;"><?php
                                    $count = 0;
                                    if($get_data==1){
                                        $res = fetch_bin_by_type_wm($conn,$gb,$type);
                                    }
                                    else{
                                        $res = fetch_bin($conn);
                                    }
                                    while($dis_row=mysqli_fetch_array($res)){
                                        if($dis_row['status']==1){
                                            $count++;
                                        }
                                    }
                                    echo $count;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="font-size: 18px; padding:10px;">Empty Bins</td>
                            <td style="font-size: 18px; padding:10px;"><?php
                                    $count = 0;
                                    if($get_data==1){
                                        $res = fetch_bin_by_type_wm($conn,$gb,$type);
                                    }
                                    else{
                                        $res = fetch_bin($conn);
                                    }
                                    while($dis_row=mysqli_fetch_array($res)){
                                        if($dis_row['status']==0){
                                            $count++;
                                        }
                                    }
                                    echo $count;
                                ?>  
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>

    </div>
    <?php
    function map_view($result,$center){

     ?>    
    <script>
        var map = L.map('map_1').setView([<?php echo $center['lat']; ?>,<?php echo $center['lon']; ?>],12);
		L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
		attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
		}).addTo(map);

        var icon_3 = L.icon({
            iconUrl: '../assets/img/small_red.ico',
            iconSize: [40,40],
            iconAnchor: [20,40]
        });

        var icon_1 = L.icon({
            iconUrl: '../assets/img/small_green.ico',
            iconSize: [40,40],
            iconAnchor: [20,40]
        });
        var icon_6 = L.icon({
            iconUrl: '../assets/img/large_red.ico',
            iconSize: [40,40]
        });
        var icon_4 = L.icon({
            iconUrl: '../assets/img/large_green.ico',
            iconSize: [40,40]
        });
        var icon_5 = L.icon({
            iconUrl: '../assets/img/large_blue.ico',
            iconSize: [40,40],
        });
        var icon_9 = L.icon({
            iconUrl: '../assets/img/con_red.ico',
            iconSize: [40,40],
        });
        var icon_7 = L.icon({
            iconUrl: '../assets/img/con_green.ico',
            iconSize: [40,40],
        });
        var icon_8 = L.icon({
            iconUrl: '../assets/img/con_blue.ico',
            iconSize: [40,40],
        });

        <?php
            while($row=mysqli_fetch_array($result)){
                if (!strcmp($row['type'],"S")){
                    if($row['status']=='0'){
                        ?> 
                        var markerOption = {
                            icon: icon_1
                        } 
                        <?php
                    }
                    elseif ($row['status']=='2'){
                        ?>
                        var markerOption = {
                        icon: icon_3
                        }
                        <?php
                    }
                    else{
                        ?>
                        var markerOption = {
                        }
                        <?php
                    }
                }
                elseif (strcmp($row['type'],"L")==0){
                    if($row['status']=='0'){
                        ?> 
                        var markerOption = {
                            icon: icon_4
                        } 
                        <?php
                    }
                    elseif ($row['status']=='1'){
                        ?>
                        var markerOption = {
                        icon: icon_5
                        }
                        <?php
                    }
                    else{
                        ?>
                        var markerOption = {
                            icon: icon_6 
                        }
                        <?php
                    }
                }
                else{
                    if($row['status']=='0'){
                        ?> 
                        var markerOption = {
                            icon: icon_7
                        } 
                        <?php
                    }
                    elseif ($row['status']=='1'){
                        ?>
                        var markerOption = {
                        icon: icon_8
                        }
                        <?php
                    }
                    else{
                        ?>
                        var markerOption = {
                            icon: icon_9
                        }
                        <?php
                    }
                }
                    ?>
                var marker = L.marker([<?php echo $row['lat']; ?>,<?php echo $row['lon']; ?>],markerOption).addTo(map);
                marker.bindPopup("<?php echo $row['b_name']; ?>");
                <?php
            } 
        ?>
    </script>

    <?php 
    }
    if($get_data==1){
        $res = fetch_bin_by_type_wm($conn,$gb,$type);
    }
    elseif($get_data==2){
        $res = fetch_bin($conn);
    }
    map_view($res,$cen);
    ?>
<?php
    include 'admin_footer.php';
?>