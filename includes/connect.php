<?php
session_start();
$servername = "localhost";
$server_user = "crypkbij_cryptomayday";
$server_pass = "crypkbij_cryptomayday";
$dbname = "crypkbij_cryptomayday";
$name = $_SESSION['name'];
$role = $_SESSION['role'];
$con = new mysqli($servername, $server_user, $server_pass, $dbname);
?>
