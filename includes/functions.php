<?php 

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

?>
