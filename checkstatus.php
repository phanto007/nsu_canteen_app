<?php
include 'includes/connect.php';
include 'includes/wallet.php';

if($_SESSION['customer_sid']==session_id())
{
	$counts = 0;
	$result = mysqli_query($con, "SELECT COUNT(*) AS isupdated FROM orders where status_delivered='0' AND customer_id=$user_id;");
	while($row = mysqli_fetch_array($result))
	{
		$counts = $row["isupdated"];
	}

	if($counts>0){
		$sql = "UPDATE orders SET status_delivered = '1' WHERE customer_id ='$user_id';";
		$con->query($sql);
		die('1');
	}
	die('0');
}
