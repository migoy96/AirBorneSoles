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
        if ($function == 'uploadProfPic') {
            $img = $_POST['img-value'];
            $id = $_POST['id'];

            $filename = $_FILES['chooseprofile']['name'];
            $tempname = $_FILES['chooseprofile']['tmp_name'];
            $folder = "capstone_project/public/images/".$filename;
            $sql = "UPDATE `user_tbl` SET `user_picture`='$filename' WHERE `user_id`='$id'";
            move_uploaded_file($tempname, $folder);
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