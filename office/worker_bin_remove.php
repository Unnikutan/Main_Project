<?php 
    include '../db/connection.php';

    $bin_id = $_GET['id'];
    $driver_id = $_GET['id2'];
    $query = "update tbl_bins set pick_up = null where bin_id = '$bin_id'";
    $res = mysqli_query($conn,$query);

    if ($res){
        ?>
        <script> 
            alert("Bin successfully removed from collector");
            window.location.href = "worker_assign_bin.php?worker_id=<?php echo $driver_id ?>";
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert("Cannot remove due to technical failure");
            window.location.href = "worker_assign_bin.php?worker_id=<?php echo $driver_id ?>";
        </script>
        <?php
    }
?>