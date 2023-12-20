<?php
header("Access-Control-Allow-Origin: *");
include 'db_con.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        $sql = "SELECT * FROM `user_tbl`";
        break;
    case 'POST':
        $function = $_POST['function'];
        if ($function == 'upUserInfo') {
            $userid = $_POST['upId'];
            $username = $_POST['username'];
            $user_fname = $_POST['upFname'];
            $user_lname = $_POST['upLname'];
            $user_mname = $_POST['upMname'];
            $user_suffix= $_POST['upSuffix'];
            $user_mobile = $_POST['upMobile'];
            $user_address = $_POST['upAddress'];
            $user_municipality= $_POST['upMunic'];
            $user_province = $_POST['upProv'];
            $sql = "UPDATE `user_tbl` SET `user_fname`='$user_fname',`user_lname`='$user_lname',`user_middlename`='$user_mname',`user_suffix`='$user_suffix',`user_address`='$user_address',`user_municipality`='$user_municipality',`user_province`='$user_province',`user_mob_number`='$user_mobile' WHERE `user_id`='$userid'";
        }
        break;
}

$result = mysqli_query($con,$sql);

echo '[';

for($i=0; $i<mysqli_num_rows($result); $i++){
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
}

echo ']';

?>