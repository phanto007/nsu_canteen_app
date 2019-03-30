<?php
include 'includes/connect.php';
include 'includes/wallet.php';
include 'includes/functions.php';

if($_SESSION['admin_sid']==session_id())
{
	$counts = 0;
	$o_id = sanitizeData($_GET['o_id']);
	$status_delivered;
	$result = mysqli_query($con, "SELECT status_delivered_2 FROM orders where id='$o_id';");
	while($row = mysqli_fetch_array($result))
	{
		$status_delivered = $row["status_delivered_2"];
	}

	if(!$status_delivered){
		$sql = "UPDATE orders SET status_delivered_2 = '1' where id='$o_id';";
		$con->query($sql);
		die('1');
	}
	die('0');
}
