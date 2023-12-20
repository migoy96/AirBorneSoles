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
        if ($function == 'uploadCredentials') {
            $fname= $_POST['firstName'];
            $lname = $_POST['lastName'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = "INSERT INTO `user_tbl`(`user_fname`, `user_lname`, `user_email`, `username`, `password`) VALUES ('$fname','$lname','$email','$username','$password')";
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