<?php
date_default_timezone_set('Asia/Kolkata');
if(isset($_GET['req'])){
    $req = $_GET['req'];
    if($req == 1){
        
    }
}

function getDateAgo($date){
    $nowTime = strtotime(date("Y-m-d H:i:s"));
    $diff_time = $nowTime - strtotime($date);
    if ($diff_time<60){
        return "Just now";
    }
    else if($diff_time>=60 && $diff_time <=3600){
        return ((($diff_time/60)%60)." minutes ago ");
    }
    else if($diff_time>=3600 && $diff_time <=86400){
        return ((($diff_time/3600)%24)." hours ago ");
    }
    else if($diff_time>86400 && $diff_time <=(86400*30)){
        return ((($diff_time/86400)%30)." days ago ");
    }
    else if($diff_time>(86400*30) && $diff_time <=(86400*365)){
        return ((($diff_time/(86400*30))%12)." months ago ");
    }
    else{
        return (($diff_time/(86400*365))%(86400*365))." years ago";
    }
}

// ===================================
// Query related to notifiation table
// ===================================
function clear_notification_by_wm($conn,$id,$type){
    $query = "delete from tbl_not where type = '$type' and user_id = '$id' and mark_read != 0 ";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_notification($conn,$id,$type){
    $query = "select * from tbl_not where type = '$type' and user_id = '$id' order by not_time desc";
    $res = mysqli_query($conn,$query);

    return $res;
}

function mark_as_read($conn,$id){
    $query = "update tbl_not set mark_read = 1 where id = '$id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_one_notification($conn,$id){
    $query = "select * from tbl_not where id = '$id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function insert_notification($conn,$type,$user_id,$title,$sub,$object){
    $query = "insert into tbl_not(type,user_id,title,sub,object_id,mark_read) values('$type','$user_id','$title','$sub','$object','0')";
    $res = mysqli_query($conn,$query);

    return $res;
}


// ===================================
// Query related to request bin table
// ===================================

function fetch_request_by_id($conn,$gb_id){
    $query = "select * from tbl_requestbin where gb_id = '$gb_id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function insert_to_request($conn,$gb_id,$type,$amount){
    $date = date("Y-m-d");
    $query = "insert into tbl_requestbin(gb_id,type,num,date) values('$gb_id','$type','$amount','$date')";
    $row = mysqli_query($conn,$query);

    return $row;
}

function select_request($conn){
    $query = "select * from tbl_requestbin where status = 0";
    $row = mysqli_query($conn,$query);

    return $row;
}

function update_request_status($conn,$status,$id){
    $query = "update tbl_requestbin set status = '$status' where id = '$id'";
    $row = mysqli_query($conn,$query);

    return $row;
}

function update_request_comment($conn,$comment,$id){
    $query = "update tbl_requestbin set comment = '$comment' where id = '$id'";
    $row = mysqli_query($conn,$query);

    return $row;
}

function fetch_last_request($conn){
    $query = "select * from tbl_requestbin order by id desc limit 1";
    $row = mysqli_query($conn,$query);

    return $row;
}
// ============================
// Query related to bin table
// ============================

function fetch_bin($conn){
    $query = "select * from tbl_bins";
    $row = mysqli_query($conn,$query);

    return $row;
}

function fetch_bin_by_type_wm($conn,$gb_id,$type){
    if(!strcmp($type,"All") || $gb_id==0){
        if(strcmp($type,"All")){
            $query = "select * from tbl_bins where type = '$type'";
        }
        elseif($gb_id!=0){
            $query = "select * from tbl_bins where gb_id = '$gb_id'";
        }
        else{
            $query = "select * from tbl_bins";
        }
    }
    else{
        $query = "select * from tbl_bins where type = '$type' and gb_id = '$gb_id'";
    }
    $row = mysqli_query($conn,$query);

    return $row;
}

function insert_to_bin($conn,$name,$off_id,$lat,$lon,$address,$type){
    $query = "insert into tbl_bins(b_name,gb_id,lat,lon,type,location) values('$name','$off_id','$lat','$lon','$type','$address')";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_bin_by_collector($conn,$pick,$gb_id){
    $query = "select * from tbl_bins where pick_up = '$pick' and gb_id = '$gb_id'";
    $res = mysqli_query($conn,$query);

    return $res;
}
function fetch_bin_by_collector_type($conn,$pick,$gb_id,$type){
    $query = "select * from tbl_bins where pick_up = '$pick' and gb_id = '$gb_id' and type='$type'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_bin_by_no_collector_type($conn,$gb_id,$type){
    $query = "select * from tbl_bins where pick_up is null and gb_id = '$gb_id' and type='$type'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function select_bin_by_status($conn,$pick_up,$status){
    $query = "select * from tbl_bins where pick_up = '$pick_up' and status = '$status'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_bin_by_gb($conn,$gb_id){
    $query = "select * from tbl_bins where gb_id = '$gb_id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function update_bin_by_pick($conn,$driver,$id){
    $query = "update tbl_bins set pick_up = '$driver' where bin_id = '$id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

// ============================
// Query related to GB table
// ============================

function gb_fetch_by_user($conn,$user){
    $query = "select * from tbl_gb where username = '$user'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function reduce_bin_amount($conn,$type,$gb_id){
    if (!strcmp($type,"S")){
        $query = "update tbl_gb set small_bin = small_bin - 1 where gb_id = '$gb_id'";
    }
    elseif(!strcmp($type,"L")){
        $query = "update tbl_gb set large_bin = large_bin - 1 where gb_id = '$gb_id'";
    }
    else{
        $query = "update tbl_gb set container = container - 1 where gb_id = '$gb_id'";
    }
    $res = mysqli_query($conn,$query);

    return $res;
    
}

function insert_to_gb($conn,$gb_name,$person,$position,$address,$username,$password){
    $query = "insert into tbl_gb(gb_name,person,position,address,small_bin,large_bin,container,total_bin,username,password) values('$gb_name','$person','$position','$address',41,8,1,50,'$username','$password')";
    $res = mysqli_query($conn,$query);

    return $res;
}


function update_total_bin($conn,$gb_id,$amt){
    $query = "update tbl_gb set total_bin = total_bin + '$amt' where gb_id = '$gb_id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function update_each_bin($conn,$gb_id,$type,$num){
    if(!strcmp($type,"S")){
        $query = "update tbl_gb set small_bin = small_bin + $num where gb_id = '$gb_id'";
    }
    elseif(!strcmp($type,"L")){
        $query = "update tbl_gb set large_bin = large_bin + $num where gb_id = '$gb_id'";
    }
    else{
        $query = "update tbl_gb set container = container + $num where gb_id = '$gb_id'";
    }
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_gb_id($conn){
    $query = "SELECT gb_id from tbl_gb ORDER BY gb_id DESC LIMIT 1";
    $res = mysqli_query($conn,$query);

    return $res;
}


function fetch_all_gb($conn){
    $query = "select * from tbl_gb";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_gb_by_id($conn,$id){
    $query = "select * from tbl_gb where gb_id = '$id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

// ============================
// Query related to login table
// ============================

function insert_to_login($conn,$username,$password,$type,$enter_id){
    $query = "insert into tbl_login(username,password,type,enter_id) values('$username','$password','$type','$enter_id')";
    $res = mysqli_query($conn,$query);

    return $res;
}

function check_username($conn,$username){
    $query = "select * from tbl_login where username = '$username'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function check_login_credentials($conn,$username,$password){
    $query = "select * from tbl_login where username='$username' and password = '$password'";
    $res = mysqli_query($conn,$query);

    return $res;
}



// ============================
// Query related to Truck table
// ============================

function fetch_all_trucks($conn){
    $query = "select * from tbl_truck";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_truck_by_gb($conn,$gb){
    $query = "Select * from tbl_truck where gb_id='$gb'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_truck_by_driver($conn,$id){
    $query = "Select truck_no from tbl_truck where driver_id='$id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

// ==============================
// Query related to Driver table
// ==============================

function fetch_driver_by_gb($conn,$gb_id){
    $query = "select * from tbl_driver where gb_id='$gb_id'";
    $res = mysqli_query($conn,$query);

    return $res;
}
function fetch_driver_by_id($conn,$id){
    $query = "select * from tbl_driver where id='$id'";
    $res = mysqli_query($conn,$query);

    return $res;
}
function fetch_drivers_by_type($conn,$type){
    $query = "select * from tbl_driver where type='$type'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_drivers_by_type_gb($conn,$type,$gb_id){
    $query = "select * from tbl_driver where type='$type' and gb_id='$gb_id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_all_drivers($conn){
    $query = "select * from tbl_driver";
    $res = mysqli_query($conn,$query);

    return $res;
}

// ======================================
// Query related to Office Location table
// ======================================

function fetch_off_loc_by_id($conn,$gb_id){
    $query="Select * from tbl_office where gb_id = '$gb_id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function update_office($conn,$enter_id,$name){
    $query = "update tbl_office set gb_id = '$enter_id' where name = '$name'";
    $res = mysqli_query($conn,$query);

    return $res;
}

// =======================================
// Query related to User table
// =======================================

function insert_user($conn,$name,$age,$gender,$address,$aadhaar,$pin,$phno,$photo,$off,$email,$pass){
    $query = "insert into tbl_user(name,age,gender,address,aadhaar,pin,phno,photo,gb_id,email,password) value('$name','$age','$gender','$address','$aadhaar','$pin','$phno','$photo','$off','$email','$pass')";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_last_user($conn){
    $query = "SELECT u_id from tbl_user ORDER BY u_id DESC LIMIT 1";
    $res = mysqli_query($conn,$query);

    return $res;
}

function select_user_by_id($conn,$id){
    $query = "SELECT * from tbl_user where u_id = '$id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function select_user_by_gb($conn,$gb_id){
    $query = "SELECT * from tbl_user where gb_id = '$gb_id'";

    $res = mysqli_query($conn,$query);
    return $res;
}

function fetch_all_users($conn){
    $query = "SELECT * from tbl_user";

    $res = mysqli_query($conn,$query);
    return $res;
}


// =======================================
// Query related to Route table
// =======================================

function select_route_by_day($conn,$day){
    if ($day == 0){
        $query = "SELECT * FROM tbl_route where gb_id is null";
    }
    else{
        $query = "SELECT * from tbl_route where day = '$day' and gb_id is null";
    }
    $res = mysqli_query($conn,$query);

    return $res;
}

function select_route_by_day_gb($conn,$day,$gb_id){
    if ($day == 0){
        $query = "SELECT * FROM tbl_route where gb_id ='$gb_id'";
    }
    else{
        $query = "SELECT * from tbl_route where day = '$day' and gb_id ='$gb_id'";
    }
    $res = mysqli_query($conn,$query);

    return $res;
}

// =======================================
// Query related to Route Details table
// =======================================

function select_path_by_id($conn,$id){
    $query = "SELECT * from tbl_route_details where route_id = '$id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

// =======================================
// Query related to Compliants table
// =======================================

function fetch_comp_by_id($conn,$id){
    $query = "select * from tbl_comp where id='$id'";
    $res = mysqli_query($conn,$query);

    return $res;
}
function fetch_comp_by_type($conn,$type){
    $query = "select * from tbl_comp where status='$type'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_comp_by_gb_id($conn,$gb_id){
    $query = "select * from tbl_comp where gb_id='$gb_id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_comp_by_type_gb($conn,$type,$gb_id){
    $query = "select * from tbl_comp where status='$type' and gb_id='$gb_id'";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_all_comp($conn){
    $query = "select * from tbl_comp";
    $res = mysqli_query($conn,$query);

    return $res;
}

function fetch_last_comp($conn){
    $query = "select * from tbl_comp order by id desc limit 1";
    $res = mysqli_query($conn,$query);

    return $res;
}

function insert_compliant($conn,$type,$dr_id,$gb_name,$issue,$descrip,$status){
    $query = "INSERT INTO tbl_comp(type,enter_id,gb_id,topic,descrip,status) VALUES('$type','$dr_id','$gb_name','$issue','$descrip','$status')";
    $res = mysqli_query($conn,$query);

    return $res;
}
?>

