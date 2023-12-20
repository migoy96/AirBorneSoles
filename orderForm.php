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
        if ($function == 'uploadOrder') {
            $customerId = $_POST['customerId'];
            $prodprice = $_POST['prod_total_price'];
            $prodname = $_POST['prod_name'];
            $prodreceipt = $_POST['prod_receipt'];
            $produsername = $_POST['prod_username'];
            $prodcategory = $_POST['prod_category'];
            $prodqty = $_POST['prod_orderqty'];
            $prodorderdate = $_POST['prod_orderdate'];
            $sql = "INSERT INTO `orderdetails_tbl`(`orderReceipt_number`, `order_totalprice`, `order_name`, `customer_id`, `order_username`, `order_category`, `order_date`,`order_qty`) VALUES ('$prodreceipt','$prodprice','$prodname','$customerId','$produsername','$prodcategory','$prodorderdate','$prodqty')";
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