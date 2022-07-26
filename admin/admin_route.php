<?php
    $make_nav=7;
    include '../db/connection.php';
	include 'admin_header.php';
    include '../controls/admin_controls.php';
    include 'map.php';
    if (isset($_POST['submit'])){
        $route_option = $_POST['route_day'];
        if ($route_option == 1){
            $day = date('N');
        }
        else{
            $day = 0;
        }
    }
    else{
        $day = 0;
    }
    $assign = 0;
    if(isset($_POST['optimum'])){
        $assign = 1;
    }

?>
    <div class="container">
    <div class="admin_row_2 mt-3">
		<a href="admin_add_route.php"><button class="admin_btn3">Add New route</button></a>
	</div>
        <div class="row">
            <div class="admin_mnc_head brd">
                All Routes
	        </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="">
                    <div class="text-center p-4 border-bottom">
                        Day : 
                        <select name="route_day" class="w-25 mx-2 p-1 rounded bg-light text-center">
                            <option value=2>All Days</option>
                            <option value=1>Today</option>
                        </select>
                        <button type="submit" name="submit" class="btn btn-dark py-0">Submit</button>
                    </div>
                </form>
                
                
                <table class="table table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th> # </th>
                            <th> Route Name </th>
                            <th> Details </th>
                            <th> Route Day </th>
                            <th> View Route </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $res = select_route_by_day($conn,$day);
                            $i=0;
                            while($row_route = mysqli_fetch_array($res)){
                                if($row_route['itr']==0){
                                $i++;
                                ?>
                                <form method="post" action="">
                                    <input type="text" name="route_id" value="<?php echo $row_route['route_id'] ?>" hidden>
                                    <tr>
                                        
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row_route['route_name'] ?> </td>
                                        <td><?php echo $row_route['details'] ?> </td>
                                        <td><?php
                                            if($row_route['day']==0){
                                                ?>
                                                    <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#assignModal<?php echo $i ?>">Assign</button>
                                                <?php
                                            }
                                            else{
                                                if($row_route['day']==1)
                                                    echo "Monday";
                                                elseif($row_route['day']==2)
                                                    echo "Tuesday";
                                                elseif($row_route['day']==3)
                                                    echo "Wednesday";
                                                elseif($row_route['day']==4)
                                                    echo "Thursday";
                                                elseif($row_route['day']==5)
                                                    echo "Friday";
                                                elseif($row_route['day']==6)
                                                    echo "Saturday";
                                                elseif($row_route['day']==7)
                                                    echo "Sunday";
                                            }
                                        ?>
                                        </td>
                                        <td>
                                            <button type="submit" name="view_submit" class="btn btn-secondary"> view route</button>
                                        </td>
                                    </tr>

                                </form>
                                <form method="post" action="admin_route_day_assign.php">
                                <div class="modal fade" id="assignModal<?php echo $i ?>" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Select Day</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                    <input type="text" name="route_id" value="<?php echo $row_route['route_id'] ?>" hidden>
                                        Day :  
                                        <select name="rt_day" class="w-25 p-1 bg-light rounded">
                                            <option value="1">Monday</option>
                                            <option value="2">Tuesday</option>
                                            <option value="3">Wednesday</option>
                                            <option value="4">Thursday</option>
                                            <option value="5">Friday</option>
                                            <option value="6">Saturday</option>
                                            <option value="7">Sunday</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="approve_submit">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </form>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <div id="route_map1" class="mt-4" style="height:50vh; border:1px solid black;"></div>
            </div>
            <div class="text-center p-3">
                <div class="row">
                    <div class="col-sm-6">
                        <form method="post" action="">
                            <button class="btn btn-success" type="submit" name="optimum"> Find Optimized Route</button>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <form method="post" action="admin_route_reassign.php">
                            <button class="btn btn-success" type="submit" name="optimum" <?php echo ($assign)? "" : "hidden" ?>> Assign Route</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        if(isset($_POST['view_submit'])){
            $route_id = $_POST['route_id'];
            $res = select_path_by_id($conn,$route_id);
            path($conn,$res);
        }
        elseif(isset($_POST['optimum'])){
            $bin = "select * from tbl_bins where type='C' and status = 2";
            $query_bin = mysqli_query($conn,$bin);
            path_optimum($conn,$query_bin);
        }
        else{

    ?>
    <script type="text/javascript">
		var map = L.map('route_map1').setView([8.957796454971353,76.98957829736175],12);
		L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=rnildL47RCqVyg8E4kOb',{
		attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
		}).addTo(map);
	</script>
<?php
    }
    include 'admin_footer.php';
?>
