<?php
header("Access-Control-Allow-Origin: *");
include 'db_con.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Use SUM and GROUP BY to get the total quantity for each username
        $sql = "SELECT cartitem_username, SUM(cartitem_quantity) AS totalQuantity FROM `addtocartitem_tbl` GROUP BY cartitem_username";
        break;
    // Add other cases if needed...
}

$result = mysqli_query($con, $sql);

echo '[';

for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
}

echo ']';
?>