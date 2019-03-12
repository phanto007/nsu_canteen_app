<?php
include '../includes/connect.php';
include '../includes/functions.php';

$name = sanitizeData($_POST['name']);
$email = sanitizeData($_POST['email']);
$username = sanitizeData($_POST['username']);
$password = sanitizeData($_POST['password']);

// Hashing password
$password = hashData($password);

// Generate unique string for user
$string = generateRandomString(13);

$sql = "INSERT INTO users (name, username, password, email, string) VALUES ('$name', '$username', '$password', '$email', '$string');";
$con->query($sql);
$user_id =  $con->insert_id;
$sql = "INSERT INTO wallet(customer_id) VALUES ($user_id)";
$con->query($sql);
header("location: ../login.php");
?>
