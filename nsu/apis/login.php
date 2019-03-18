<?php
include('../functions/functions.php');

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['api_key']) && $_POST['api_key']==api_key){
	$email = sanitizeData($_POST['email']);
	$password = sanitizeData($_POST['password']);

	die(login($email, $password));
}
?>