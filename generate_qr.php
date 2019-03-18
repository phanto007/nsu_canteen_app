<?php
include 'includes/connect.php';
include 'includes/wallet.php';
include 'includes/functions.php';

if($_SESSION['admin_sid']==session_id() && isset($_GET['o_id']))
{
	$o_id = sanitizeData($_GET['o_id']);
	$sql = mysqli_query($con, "SELECT verification_string FROM orders WHERE id = $o_id");
	$verification_string = "";
	while($row = mysqli_fetch_array($sql))
	{
		$verification_string = $row['verification_string'];
	}

	$sql = mysqli_query($con, "SELECT pkey FROM users WHERE id = $user_id");
	$pkey = "";

	while($row = mysqli_fetch_array($sql))
	{
		$pkey = $row['pkey'];
	}

	$qr_string = my_simple_crypt($verification_string,'e',$pkey);

	$string = '<h3>Order No. '.$o_id.'</h3>'.
			  '<br>'.
			  '<h4>QR String: '.$qr_string.'</h4>'.
			  '<br>';

	die($string."<img alt='$qr_string' height='500' width='500' src='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=$qr_string'>");
	

	
}else{

	header("location:login.php");
}

?>