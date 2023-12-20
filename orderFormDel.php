<?php
header("Access-Control-Allow-Origin: *");
include 'db_con.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        $sql = "SELECT * FROM `user_tbl`";
        break;
    case 'POST':    
        $function2 = $_POST['function2'];
        if ($function2 == 'deleteaddOrder') {
            $produsernamedelete = $_POST['prod_usernamedelete'];
            $sql = "DELETE FROM `addtocartitem_tbl` WHERE `cartitem_username` = '$produsernamedelete'";
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