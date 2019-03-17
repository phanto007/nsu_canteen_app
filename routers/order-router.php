<?php
include '../includes/connect.php';
include '../includes/wallet.php';
include '../includes/functions.php';
$total = 0;

$description =  "";

if(isset($_POST['description'])){
	$description = htmlspecialchars($_POST['description']);
}
foreach ($_POST as $key => $value)
{
	if(is_numeric($key)){
		$total = $total + getPrice($key);
	}
}

if($total > $balance){
	header("location: ../recharge.php?bal=insufficient");
	die();
}

$balance = $balance - $total;
$sql = "UPDATE wallet SET balance = $balance WHERE customer_id = $user_id;";
if(!$con->query($sql)){
	die('DB ERROR');
}


$str = generateRandomString(13);

$sql = "INSERT INTO orders (customer_id, total, description, verification_string) VALUES ($user_id, $total, '$description', '$str')";
if ($con->query($sql) === TRUE){
	$order_id =  $con->insert_id;
	foreach ($_POST as $key => $value)
	{
		if(is_numeric($key)){

			$result = mysqli_query($con, "SELECT * FROM items WHERE id = $key");
			while($row = mysqli_fetch_array($result))
			{
				$price = $row['price'];
			}
			$price = $value*$price;
			$sql = "INSERT INTO order_details (order_id, item_id, quantity, price) VALUES ($order_id, $key, $value, $price)";
			$con->query($sql) === TRUE;		
		}
	}
		header("location: ../orders.php");
}

function getPrice($itemID){
    global $con;
    $sql = mysqli_query($con, "SELECT price FROM items WHERE id='$itemID' AND deleted='0'");
    if(!$sql) die();
    if (mysqli_num_rows($sql) == 1){
        $result = mysqli_fetch_assoc($sql);
        return $result['price']; 
    }else{
        die('Item not available');
    }
}

?>
