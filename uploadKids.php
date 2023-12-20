<?php
header("Access-Control-Allow-Origin: *");
include 'db_con.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        $sql = "SELECT * FROM `kidscategory_tbl`";
        break;
    case 'POST':
        $function = $_POST['function'];
        if ($function == 'uploadKids') {
            $img = $_POST['img-value'];

            $prodname = $_POST['prodname-value'];
            $prodprice = $_POST['prodprice-value'];
            $prodinventory = $_POST['prodinventory-value'];
            $filename = $_FILES['kidsChoosefile']['name'];
            $tempname = $_FILES['kidsChoosefile']['tmp_name'];
            $folder = "capstone_project/public/images/".$filename;
            $sql = "INSERT INTO `kidscategory_tbl`(`prod_name`, `prod_price`, `prod_inventory`, `prod_image`) VALUES ('$prodname','$prodprice','$prodinventory','$filename')";
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