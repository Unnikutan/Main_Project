<?php
    include '../db/connection.php';
    include '../controls/admin_controls.php';

    $id = $_REQUEST['id'];
    echo $id;
    $res = mark_as_read($conn,$id);

    if ($res){
        $notification = fetch_one_notification($conn,$id);
        $result = mysqli_fetch_array($notification);
        $notification_type = $result['title'];
        $ref = $result['object_id'];
        echo $notification_type;
        if (stristr($notification_type,"Request")){
            header("location:request_bin.php");
        }
        else if (stristr($notification_type,"Complaint")){
            header("location:comp_view.php?id=$ref");
        }
        else if (stristr($notification_type,"Route")){
            header("location:route_home.php");
        }
        else if (stristr($notification_type,"Bin")){
            header("location:view_bin.php");
        }
        else{
            ?>
            <script>
                history.back();
            </script>
            <?php
        }
    }
    else{
        ?>
        <script>
            alert("Unable to load due to server error");
        </script>
        <?php
    }


?>