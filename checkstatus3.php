<?php
include 'includes/connect.php';
include 'includes/wallet.php';

if($_SESSION['admin_sid']==session_id())
{
	$counts = 0;
	$result = mysqli_query($con, "SELECT COUNT(*) AS isupdated FROM orders where status_delivered_3='0'");
	while($row = mysqli_fetch_array($result))
	{
		$counts = $row["isupdated"];
	}

	if($counts>0){
		$sql = "UPDATE orders SET status_delivered_3 = '1'";
		$con->query($sql);
		die('1');
	}
	die('0');
}
