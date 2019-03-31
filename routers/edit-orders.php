<?php
include '../includes/connect.php';
include '../includes/functions.php';
$status = $_POST['status'];
$id = $_POST['id'];

$sql = "UPDATE orders SET status='$status', status_delivered = '0',status_delivered_2 = '0' WHERE id=$id;";
$con->query($sql);

$result = mysqli_query($con, "SELECT customer_id FROM orders WHERE id = $id;");
			while($row = mysqli_fetch_array($result))
			{
				sendNotification($row['customer_id'], "Order #".$id." Status Update: ".$status);
			}

header("location: ../all-orders.php");
?>
