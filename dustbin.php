<?php
include 'db/connection.php';
$l=$_GET['level'];
$m=$_GET['m_id'];


//$ins=mysqli_query($dbcon,"insert into d_msg1 (id,m_id,b_id,b_uid,level,st,dt) values ('','$m','$b','$buid','$l','$st','$date')");
$sql = "update tbl_bins set status='$l' where bin_id='$m'";
$ins2 = mysqli_query($conn,$sql);
 echo $ins2;
?>
 
                                       