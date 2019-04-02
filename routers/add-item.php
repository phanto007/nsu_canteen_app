<?php
include '../includes/connect.php';
include '../includes/functions.php';
//define ('SITE_ROOT', realpath(dirname(__FILE__)));

if(isset($_POST["action"]) && !empty($_FILES["file"]["name"])) {
	echo "in";
	$name = $_POST['name'];
	$price = $_POST['price'];
	$calorie = $_POST['calorie'];

	// Image upload path

	//$targetDir = "/opt/lampp/htdocs/nsu_canteen_app/images/food-items/";
	$targetDir = "C:/xampp/htdocs/nsu/images/food-items/"; // Adib change this to correct site wide file path
	$fileName = basename($_FILES["file"]["name"]);
	$targetFilePath = $targetDir . $fileName;
	$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
	$targetDirDatabase = "images/food-items/" . $fileName;

	// Upload file to correct directory
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
		$sql = "INSERT into items (name, price, calorie, image) VALUES ('$name', '$price', '$calorie', '$targetDirDatabase')";
		$con->query($sql);
		header("location: ../admin-page.php");
	}

	sendNotificationAll("New Item Available!",$name."\nPrice: ৳".$price, $fileName);
}

?>
