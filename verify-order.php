<?php
include 'includes/connect.php';
include 'includes/wallet.php';
include 'includes/functions.php';

if($_SESSION['customer_sid'] == session_id() && isset($_GET['o_id']) && isset($_GET['e_str'])) {
	
	// Encrypted string
	$e_str = $_GET['e_str'];

	// Get user pkey
	$pkey = "";

	$result = mysqli_query($con, "SELECT pkey FROM users where id = '$user_id';");

	while($row = mysqli_fetch_array($result)) {
		$pkey =  $row['pkey'];
	}

	// Get order verification string
	$verification_string = "";

	$result = mysqli_query($con, "SELECT verification_string FROM orders where customer_id ='$user_id' AND id = $o_id");

	while($row = mysqli_fetch_array($result)) {
		$verification_string = $row['verification_string'];
	}

	// Decrypted string
	$decrypted_string = my_simple_crypt($e_str, 'd', $pkey);

	// Check for match between strings
	if ($verification_string === $decrypted_string) {

		$verified = "Verified";
		$sql = "UPDATE orders SET status = '$verified' where id = '$user_id' AND id = '$o_id'";
		$con->query($sql);
		header("location:orders.php");
		
	} else {
		header("location:orders.php");
	}

} else {
	header("location:login.php");
}