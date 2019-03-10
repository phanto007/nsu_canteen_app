<?php
include '../includes/connect.php';
$name = htmlspecialchars($_POST['name']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$phone = $_POST['phone'];


$sql = "INSERT INTO users (name, username, password, contact) VALUES ('$name', '$username', '$password', $phone);";
$con->query($sql);
header("location: ../login.php");
?>
