<?php
    include 'office_header.php';
    include 'map.php';
    $off_id = $_SESSION['off_id'];
    if (isset($_POST['assign'])){
        $error = 0;
        $bins = $_POST['bins'];
        $worker_id = $_POST['worker_id'];
        foreach ($bins as $i){
            $rply = update_bin_by_pick($conn,$worker_id,$i);
            if(!$rply){
                $error = 1;
            }
        }
        if($error == 0){
            ?>
            <script>
                alert("Bins Assigned Successfully");
            </script>
            <?php
        }
        else{
            ?>
            <script>
                alert("Some Bins not assigned due to technical issue \n\t Try Again");
            </script>
            <?php
        }
    }
    elseif(isset($_REQUEST['worker_id'])){
        $worker_id = $_REQUEST['worker_id'];
    }
    else{
        $worker_id = 0;
    }


?>

<div class="container m-0">
    <form>
    <div class="row text-center">
        <div class="alert alert-success" role="alert">
            Select Worker : 
            <select class="p-1 px-3 mx-2 text-center rounded-2" name="worker_id">
                <?php
                    $worker = fetch_drivers_by_type($conn,1,$off_id);
                    while($wr = mysqli_fetch_array($worker)){
                        ?>
                        <option value="<?php echo $wr['id']; ?>"><?php echo $wr['name']; ?></option>
                        <?php
                    }
                ?>
            </select>
            <button class="btn btn-dark px-3 py-1"> Select</button>
        </div>
    </div>
    </form>
    <?php 
    if($worker_id!=0){
        if(isset($_POST['query_type'])){
            $diff_query = $_POST['val'];
            if ($diff_query == 0){
                $res1 = fetch_bin_by_type_wm($conn,$off_id,"S");
            }
            elseif($diff_query == 1){
                $res1 = fetch_bin_by_no_collector_type($conn,$off_id,"S");
            }
            elseif($diff_query == 2){
                $res1 = fetch_bin_by_collector($conn,$worker_id,$off_id);
            }
        }
        else{
            $res1 = fetch_bin_by_type_wm($conn,$off_id,"S");
            $diff_query=4;
        }
    ?>
    <div class="row mx-3">
        <div class="col-sm-6">
            <button type="button" class="reg_btn_route" id="assign_bin_click" style="width: 30%;">Assign / View Bin</button>
        </div>
        <div class="col-sm-6 text-end">
            Unassigned bin : <img src="../assets/img/unassigned.ico" style="width: 50px; height:50px;"> 
            Assigned bin <img src="../assets/img//assigned.ico" style="width: 50px; height:50px;">
        </div>
    </div>
    <div class="row m-3 my-5">
        <div class="col-md-6 office_bg_color shadow p-3 mb-5 rounded" id="content_bin_assign" style="display: none;">
			<div class="office_txt_head">
  				Assign Bins
  			</div>
            <form method="post" action=""> 
            <input type="text" value="<?php echo $worker_id ?>" name="worker_id" hidden>
			<div class="office_form-group label-floating mx-5 pt-5">
				<label class="office_control-label text-start">Select Bins</label>
				<div class="dropdown bg_color_view ">
  					<select name="bins[]" class="form-control js-example-basic-multiple-limit " multiple style="width: 100%;">
  						<option>Select</option>
                        <?php
                            $sql = fetch_bin_by_no_collector_type($conn,$off_id,"S");
                            while($prnt = mysqli_fetch_array($sql)){
                                ?>
                                <option value="<?php echo $prnt['bin_id'] ?> "> <?php echo $prnt['b_name'] ?></option>
                                <?php
                            }
                        ?>
					</select>
				</div>
			</div>
            <div class="text-center mt-5">
                <button type="submit" name="assign" class="reg_btn_route w-25">Assign</button>
            </div>
            </form>
        </div>
        <div class="col-md-6 office_bg_color shadow p-3 mb-5 rounded" id="content_bin_view">
			<div class="office_txt_head">
  				View Bins
  			</div>
            <form method="post" action="">
                <input type="text" value="<?php echo $worker_id ?>" name="worker_id" hidden>
            <div class="p-3 text-center w-100">
                <select class="w-75 text-center py-1" name="val">
                    <option value=0 <?php echo ($diff_query==0) ? "selected": ""; ?> >All bins</option>
                    <option value=1 <?php echo ($diff_query==1) ? "selected": ""; ?> >All unassigned bins</option>
                    <option value=2 <?php echo ($diff_query==2) ? "selected": ""; ?> >Worker assigned bins</option>
                </select>
                <button class="btn btn-primary py-1" type="submit" name="query_type">Go</button>
            </div>
            </form>
  			<div class="table_height_overflow">
			<table class="table table-sm table-hover">
				<tr class="table-dark">
					<th>#</th>
					<th style="width: 150px;">Bin</th>
					<th>Status</th>
                    <?php 
                        if($diff_query==2){
                            ?>
                            <th>Remove</th>
                            <?php
                        }
                    ?>
				</tr>
				<?php
				$i=1;
				while($row1=mysqli_fetch_array($res1)){
                    $bin_num = $row1['bin_id'];
				?>
				<form method="post" action="">
				<input type="text" name="id" value="<?php echo $bin_num;?>" hidden>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row1['b_name']; ?></td>
					<td>View Status</a></td>
                    <?php 
                        if($diff_query==2){
                            ?>
                            <td class="px-3"><a href="worker_bin_remove.php?id=<?php echo $bin_num?>&id2=<?php echo $worker_id ?>"><button class="btn_bin_clear" type="button" onclick="return confirm('Are you sure want to delete')"><i class="bi-trash-fill"></i></button></td>
                            <?php
                        }
                    ?>
				</tr>
				</form>
				<?php
					$i++;
					}
				?>
			</table>
			</div>
		</div>
		<div class="col-md-6">
  			<div id="office_map2">
  			</div>
  		</div>
    </div>
    <?php
        
		$res_loc = fetch_off_loc_by_id($conn,$off_id);
		$cen = mysqli_fetch_array($res_loc);
        if($diff_query == 1){
            $res1 = fetch_bin_by_no_collector_type($conn,$off_id,"S");
        }
        elseif($diff_query == 2){
            $res1 = fetch_bin_by_collector($conn,$worker_id,$off_id);
        }
        else{
            $res1 = fetch_bin_by_type_wm($conn,$off_id,"S");
        }
        map_view_dark($res1,$cen,$conn);
    }
    ?>
</div>
<script type="text/javascript">
	$(".js-example-basic-multiple-limit").select2();

	$(".js-example-basic-multiple-limit").on("select2:select",function(evt){
		var element = evt.params.data.element;
		var $element = $(element);

		$element.detach();
		$(this).append($element);
		$(this).trigger("change");
	})
</script>
    <?php
    include 'office_footer.php';
?>