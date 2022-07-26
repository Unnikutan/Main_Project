<?php
    include '../db/connection.php';

    $id = $_POST['route_id'];
    $day = $_POST['rt_day'];

    $sql = "update tbl_route set day = '$day' where route_id = '$id'";
    $result = mysqli_query($conn,$sql);

    if($result){
        ?>
        <script>
            alert("successfully updated route");
            window.location.href = "admin_route.php";
        </script>
        <?php
    }

?>