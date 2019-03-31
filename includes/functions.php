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

function my_simple_crypt($string, $action, $secret_key="") {
    // you may change these values to your own

    
    if($secret_key=""){
        $secret_key = 'fay37udmdfiw1';
    }
    $secret_iv = 'fay37udmdfiw1_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return $output;
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendNotification($userid, $message){

    $content = array(
        "en" => $message
    );

    $heading = array(
        "en" => "NSU Canteen"
    );
    
    $fields = array(
        'app_id' => "d8bb0455-71e2-4ccd-af9a-ce48767d1709",
        'filters' => array(array("field" => "tag", "key" => "userid", "relation" => "=", "value" => $userid)),
        'data' => array("foo" => "bar"),
        'headings' => $heading,
        'contents' => $content
    );
    
    $fields = json_encode($fields);

    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                               'Authorization: Basic OWU3MzEzMjEtNmU4ZS00MjAzLWFkNWItZDljMjBjMTliNTFh'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
    
}

function sendNotificationAll($title, $message, $img){

    $content = array(
        "en" => $message
    );

    $heading = array(
        "en" => $title
    );

    $hashes_array = array();
    array_push($hashes_array, array(
        "id" => "like-button",
        "text" => "View",
        "icon" => "https://cryptomayday.com/images/food-items/".$img,
        "url" => "https://cryptomayday.com"
    ));
    
    $fields = array(
        'app_id' => "d8bb0455-71e2-4ccd-af9a-ce48767d1709",
        'included_segments' => array(
            'All'
        ),
        'data' => array("foo" => "bar"),
        'contents' => $content,
        'headings' => $heading,
        'web_buttons' => $hashes_array

    );

    
    $fields = json_encode($fields);

    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                               'Authorization: Basic OWU3MzEzMjEtNmU4ZS00MjAzLWFkNWItZDljMjBjMTliNTFh'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
    
}

?>
