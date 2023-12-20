<?php
header("Access-Control-Allow-Origin: *");
include 'db_con.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        $sql = "SELECT * FROM `addtocartitem_tbl`";
        break;
    // case 'POST':
    //     $function = $_POST['function'];
    //     if ($function == 'addToCart') {
    //         $cartProd = $_POST['addcartItem'];
    //         $cartQty = $_POST['addcartQty'];
    //         $cartCategory = $_POST['addcartCategory'];
    //         $cartPrice = $_POST['addcartPrice'];
    //         $cartUser = $_POST['addcartUser'];  
    //         $cartUserId = $_POST['addcartuserid'];
    //         $sql = "INSERT INTO `addtocartitem_tbl`(`cartitem_prodname`, `cartitem_category`, `cartitem_quantity`, `cartitem_price`, `cartitem_username`, `cartitem_customerid`) VALUES ('$cartProd','$cartCategory','$cartQty','$cartPrice','$cartUser','$cartUserId')";
    //     }
    //     break;
} 

$result = mysqli_query($con,$sql);

echo '[';

for($i=0; $i<mysqli_num_rows($result); $i++){
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
}

echo ']';

?>