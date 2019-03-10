<?php
include '../includes/connect.php';
include '../includes/wallet.php';
$total = 0;
$description =  htmlspecialchars($_POST['description']);
foreach ($_POST as $key => $value)
{
	if(is_numeric($key)){
		$total = $total + getPrice($itemID);
	}
}
$balance = getBalance($user_id);

if($total > $balance){
	header("location: ../recharge.php?bal=insufficient");
	die();
}

$balance = $balance - $total;
$sql = "UPDATE walleT SET balance = $balance WHERE customer_id = $user_id;";
if(!$con->query($sql)){
	die('DB ERROR');
}


$sql = "INSERT INTO orders (customer_id, address, total, description) VALUES ($user_id, '$address', $total, '$description')";
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

function getBalance($customer_id){
    global $con;
    $sql = mysqli_query($con, "SELECT balance FROM wallet WHERE customer_id='$user_id'");
    if(!$sql) die();
    if (mysqli_num_rows($sql) == 1){
        $result = mysqli_fetch_assoc($sql);
        return $result['balance']; 
    }else{
        die('User not available');
    }
}

?>
