<?php 
    include '../db/connection.php';
    include '../controls/admin_controls.php';

    extract($_POST);

    $res = clear_notification_by_wm($conn,$gb_id,3);
?>