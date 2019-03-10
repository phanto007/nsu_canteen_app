<?php
include '../includes/connect.php';

// Sanitizing user data
function sanitizeData($data) {
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function hashData($data){
    $options = ['cost' => 12];
    return password_hash($data, PASSWORD_DEFAULT, $options);
}

function insertData($data) {
	return mysqli_real_escape_string($con, $data);
}

$name = sanitizeData($_POST['name']);
$email = sanitizeData($_POST['email']);
$username = sanitizeData($_POST['username']);
$password = sanitizeData($_POST['password']);

// Hashing password
$password = hashData($password);

$sql = "INSERT INTO users (name, username, password, email) VALUES ('$name', '$username', '$password', '$email');";
$con->query($sql);
$user_id =  $con->insert_id;
$sql = "INSERT INTO wallet(customer_id) VALUES ($user_id)";
$con->query($sql);
header("location: ../login.php");
?>
