<?php
include 'includes/connect.php';
include 'includes/wallet.php';
include 'includes/functions.php';

// && isset($_POST['o_id'] && isset($_POST['e_str']))
if($_SESSION['customer_sid'] == session_id()) {
	
	// Get user pkey
	$pkey = "";

	$result = mysqli_query($con, "SELECT pkey FROM users where id = '$user_id';");

	while($row = mysqli_fetch_array($result)) {
		$pkey =  $row['pkey'];
	}

	echo 'pkey: '.$pkey;

	echo '<br>';

	// Get order verification string
	$o_id = '11';
	$verification_string = "";
	$result = mysqli_query($con, "SELECT verification_string FROM orders where customer_id ='$user_id' AND id = $o_id");

	while($row = mysqli_fetch_array($result)) {
		$verification_string = $row['verification_string'];
	}

	echo 'verification_string from order table: '.$verification_string;

	echo '<br>';

	$e_str = "";

	$e_str = my_simple_crypt($verification_string, 'e', $pkey);

	echo 'encrypted string: '.$e_str;

	echo '<br>';


	$decrypted_string = my_simple_crypt($e_str, 'd', $pkey);

	echo 'decrypted string: '.$decrypted_string;

	if ($decrypted_string === $verification_string ) {
		$verified = "Verified";

		echo '<br>';
		echo 'Updating status<br>';
		$sql = "UPDATE orders SET status = '$verified' where id = '$user_id' AND id = '$o_id'";
		$con->query($sql);
		sleep(1);

		//header("location:orders.php");
	}
	else {
		header("location:orders.php");
	}

} else {
	header("location:login.php");
}