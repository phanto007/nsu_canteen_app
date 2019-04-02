<?php
include '../includes/connect.php';
include '../includes/wallet.php';
include '../includes/functions.php';


if($_SESSION['admin_sid']==session_id())
{
	$total = 0.0;

	$description =  "";

	if(isset($_POST['description'])){
		$description = htmlspecialchars($_POST['description']);
	}
	foreach ($_POST as $key => $value)
	{
		if(is_numeric($key)){
			$total = $total + (getPrice($key) * $value);
		}
	}
	$payment_type = $_POST['payment_type'];
	$sql = "INSERT INTO orders (customer_id, is_manual_order, payment_type, total, description, status_delivered, status_delivered_2, status_delivered_3) VALUES ($user_id, '1', '$payment_type', $total, '$description', '0', '0', '0')";
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
		header("location: ../all-orders.php");
	}
	
}elseif (($_SESSION['customer_sid']==session_id())){
	$total = 0.0;

	$description =  "";
	$payment_type = $_POST['payment_type'];

	if(isset($_POST['description'])){
		$description = htmlspecialchars($_POST['description']);
	}
	foreach ($_POST as $key => $value)
	{
		if(is_numeric($key)){
			$total = $total + (getPrice($key) * $value);
		}
	}

	$balance = 0;
	$sql = mysqli_query($con, "SELECT balance FROM wallet WHERE customer_id='$user_id';");
    if(!$sql) die();
    if (mysqli_num_rows($sql) == 1){
        $result = mysqli_fetch_assoc($sql);
        $balance = $result['balance']; 
    }

	if($payment_type=="Wallet"){

		if($total > $balance){
			header("location: ../deposit.php?bal=insufficient");
			die('Not enough balance');
		}

		$balance = $balance - $total;
		$sql = "UPDATE wallet SET balance = $balance WHERE customer_id = $user_id;";
		if(!$con->query($sql)){
			die('DB ERROR');
		}
	}

	$str = generateRandomString(13);

	
	$sql = "INSERT INTO orders (customer_id, is_manual_order, payment_type, total, description, status_delivered, status_delivered_2, status_delivered_3) VALUES ($user_id, '0', '$payment_type', $total, '$description', '0', '0', '0')";
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
		sendNotification($user_id, "Your Order #".$order_id." has been placed!");
		header("location: ../orders.php");
	}
}else{
	die('Access denied!');
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
