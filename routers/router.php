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

$success=false;

$username = sanitizeData($_POST['username']);



$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND role='Administrator' AND not deleted;");
while($row = mysqli_fetch_array($result))
{
	
	$user_id = $row['id'];
	$name = $row['name'];
	$role= $row['role'];
	$password = $row['password'];
	if (!password_verify($_POST['password'], $password)) {
		$success = false;
	}else{
		$success = true;
	}
}
if($success == true)
{	
	session_start();
	$_SESSION['admin_sid']=session_id();
	$_SESSION['user_id'] = $user_id;
	$_SESSION['role'] = $role;
	$_SESSION['name'] = $name;

	header("location: ../admin-page.php");
}
else
{
	$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND role='Customer' AND not deleted;");
	while($row = mysqli_fetch_array($result))
	{
		$user_id = $row['id'];
		$name = $row['name'];
		$role= $row['role'];

		$password = $row['password'];
		if (!password_verify($_POST['password'], $password)) {
			$success = false;
		}else{
			$success = true;
		}
	}
	if($success == true)
	{
		session_start();
		$_SESSION['customer_sid']=session_id();
		$_SESSION['user_id'] = $user_id;
		$_SESSION['role'] = $role;
		$_SESSION['name'] = $name;			
		header("location: ../index.php");
	}
	else
	{
		header("location: ../login.php");
	}
}
?>
