<?php
include '../includes/connect.php';
include '../includes/functions.php';


$user_id = $_SESSION['user_id'];

$name = sanitizeData($_POST['name']);
$email = sanitizeData($_POST['email']);

// Hashing password
$password = hashData($_POST['password']);

$username = sanitizeData($_POST['username']);
$address = sanitizeData($_POST['address']);
$city = sanitizeData($_POST['city']);
$country = sanitizeData($_POST['country']);
$post = sanitizeData($_POST['post']);
$phone = sanitizeData($_POST['phone']);

$sql = "UPDATE users SET name = '$name', password='$password', email='$email', address='$address', city= '$city', post = '$post', country = '$country', contact = '$phone' WHERE id = $user_id;";

if($con->query($sql)==true){
	$_SESSION['name'] = $name;
}
header("location: ../details.php");
?>
