<?php
include '../includes/connect.php';
$status = $_POST['status'];
$id = $_POST['id'];

$sql = "UPDATE orders SET status='$status', status_delivered = '0' WHERE id=$id;";
$con->query($sql);

header("location: ../all-orders.php");
?>