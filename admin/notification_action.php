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
            header("location:admin_bin.php");
        }
        else if (stristr($notification_type,"Route")){
            header("location:admin_route.php");
        }
        else if (stristr($notification_type,"Bin")){
            header("location:admin_bin.php");
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