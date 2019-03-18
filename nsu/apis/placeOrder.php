<?php
include('../functions/functions.php');

appStart();
if(!isset($_POST['cart'])){
	die();
}

$itemCart = json_decode($_POST['cart'], true);

die(placeOrder($itemCart, $_POST['user_id']));

?>