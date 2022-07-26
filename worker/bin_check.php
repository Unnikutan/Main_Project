<?php
    include '../db/connection.php';
    include '../controls/admin_controls.php';

    extract($_POST);

    $res = "select * from tbl_bins where pick_up = '$id' and status = 2";
    $row = mysqli_query($conn,$res);

    $count = mysqli_num_rows($row);
    if($count > 0){
    ?>
        <div class="alert alert-danger text-center mb-5">Some bins are full<br> Collect it quickly</div>
    <?php
    }
    else{
    ?>
        <div class="alert alert-success text-center mb-5">Great work <br> All bins are under good conditions</div>
    <?php
    }
?>