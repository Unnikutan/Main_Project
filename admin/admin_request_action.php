<?php 
    include '../db/connection.php';
    include '../controls/admin_controls.php';

    if(isset($_POST['approve_submit'])){
        $id = $_POST['request_id'];
        $gb = $_POST['request_gb'];
        $amt = $_POST['request_amount'];
        $type = $_POST['request_type'];

        
        $res = update_request_status($conn,1,$id);          // update request bin
        $res2 = update_each_bin($conn,$gb,$type,$amt);      // update bin type
        $res3 = update_total_bin($conn,$gb,$amt);           // update total bin value
        if ($res & $res2 & $res3){
            ?>
            <script>
                alert("Bin approved");
                window.location.href="admin_bin.php";
            </script>
            <?php
        }
    }
    elseif(isset($_POST['reject_submit'])){
        $id = $_POST['request_id'];
        $gb = $_POST['request_gb'];
        $reason = $_POST['request_reason'];
        $res2 = update_request_comment($conn,$reason,$id);
        $res = update_request_status($conn,2,$id);
        if ($res & $res2){
            ?>
            <script>
                alert("Successfully updated");
                window.location.href="admin_bin.php";
            </script>
            <?php
        }
    }
    else{
        header("location:admin_bin.php");
    }

?>