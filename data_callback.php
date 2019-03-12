<?php
/*
	Author: Walletmix Ltd.
	Version: 2.5.4.17
	Title: Walletmix Payment Gateway Integration (data callback)
	Email: support@walletmix.com

*/

include 'includes/connect.php';
include 'includes/wallet.php';

include ('walletmix.php');



$access_username = "tanvirbux_1333650400";
$access_password = "tanvirbux_1961838250";
$merchant_id = "WMX5bfe87b60d01c";
$access_app_key = "b1135c5cb9c7321275be6ec1cde4df9c9dab19e7";

$walletmix = NEW walletmix($access_username, $access_password, $merchant_id, $access_app_key);

$walletmix->set_database_driver('session');	// options: "txt" or "session"

if(isset($_POST['merchant_txn_data'])){
	$merchant_txn_data = json_decode($_POST['merchant_txn_data']);
	
	$walletmix->get_database_driver();
	
	if($walletmix->get_database_driver() == 'txt'){
		$saved_data = json_decode($walletmix->read_file());
	}elseif($walletmix->get_database_driver() == 'session'){
		// Read data from your database
		$saved_data = json_decode($walletmix->read_data());
	}
	
	if($merchant_txn_data->token === $saved_data->token){
		
		$wmx_response = json_decode($walletmix->check_payment($saved_data));
		//$walletmix->debug($wmx_response,true);
		if(	($wmx_response->wmx_id == $saved_data->wmx_id) ){
			$order_id = $wmx_response->merchant_order_id;
			$status = $wmx_response->txn_status;
			$received_amount = $wmx_response->merchant_amount_bdt;
			//$respo = (string)$wmx_response;
			if(	($wmx_response->txn_status == '1000') ){
				if(	($wmx_response->bank_amount_bdt >= $saved_data->amount) ){
					if(	($wmx_response->merchant_amount_bdt == $saved_data->amount) ){	

						$sql = "UPDATE deposits SET txn_status='$status', received_amount='$received_amount' WHERE id='$order_id';";
						$con->query($sql);

						$result = mysqli_query($con, "SELECT customer_id FROM deposits where id = $order_id");
					    $row = mysqli_fetch_array($result);

					    $customer_id = $row['customer_id'];

						$sql = "UPDATE wallet SET balance=balance+'$received_amount' WHERE customer_id='$customer_id';";
						$con->query($sql);

						echo 'Update merchant database with success. amount : '.$wmx_response->bank_amount_bdt;
						header("location:./");
					}else{
						$sql = "UPDATE deposits SET txn_status='$status', received_amount='$received_amount' WHERE id='$order_id';";
						$con->query($sql);

						echo 'Merchant amount mismatch Merchant Amount : '.$saved_data->amount.' Bank Amount : '.$wmx_response->bank_amount_bdt.'. Update merchant database with success';
					}
				}else{
					$sql = "UPDATE deposits SET txn_status='$status', received_amount='$received_amount' WHERE id='$order_id';";
						$con->query($sql);
					echo 'Bank amount is less then merchant amount like partial payment.You can make it failed transaction.';
				}
			}else{
				$sql = "UPDATE deposits SET txn_status='$status', received_amount='$received_amount' WHERE id='$order_id';";
				$con->query($sql);
				echo 'Update merchant database with failed';
			}
		}else{
			echo 'Merchant ID Mismatch';
		}
	}else{
		echo 'Token mismatch';
	}
}else{
	echo 'Try to direct access';
}

?>