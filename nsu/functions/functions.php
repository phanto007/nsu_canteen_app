<?php

session_start();
date_default_timezone_set("Asia/Dhaka");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nsu";
$con = mysqli_connect($servername, $username, $password, $dbname);


define("api_key", "gjr-gjr4-687kh-333");



if (mysqli_connect_errno()) {
  die('Server overload, please try again after a few minutes.');
}

function login($email, $password){
    $password = hashData($password);
    $sql = mysqli_query($con, "SELECT id FROM users WHERE email='$email' AND password='$password'");
    if(!$sql) die();
    
    if (mysqli_num_rows($sql) == 1){
        $result = mysqli_fetch_assoc($sql);
        $userID = strtotime($result['id']);
        $session_hash = generateNewSessionHash($user_id);
        return $session_hash;
    }else{
        return '0';
    }
}

function signup($email, $password, $name){
    global $con;
    $timestamp = getTimeStamp();
    $password = hashData($password);
    if(!isValidateEmail($email)){
        die('Invalid Email');
    }
    $sql = mysqli_query($con,"INSERT INTO user (email, password, name, signup_timestamp) VALUES ('$email', '$password', '$name'");
    if(!$sql) die();
    return 1;
}


function appStart(){
    if(!isset($_POST['session_hash']) || !isset($_POST['user_id']) || !isset($_POST['api_key']) || $_POST['api_key']!=api_key){
        die('Please login.');
    }
    $session_hash = sanitizeData($_POST['session_hash']);
    $user_id = sanitizeData($_POST['user_id']);
    global $con;
    $sql = mysqli_query($con, "SELECT session_expiration FROM users WHERE id='$user_id' AND session_hash='$session_hash'");
    if(!$sql) die();
    
    if (mysqli_num_rows($sql) == 1){
        $result = mysqli_fetch_assoc($sql);
        $session_expiration = strtotime($result['session_expiration']);
        $curtime = time();
        if($session_expiration < $curtime){ 
          die('Session expired, please re-login.');
        }else{
            updateSessionTimeout($user_id);
        }
    }

    if(isBanned($user_id)){
        die('You have been banned!');
    }

    $_POST['user_id'] = sanitizeData($_POST['user_id']);
}

function updateSessionTimeout($userID){

    global $con;
    $newExpirationTime = date("Y-m-d H:i:s",time() + 172800);
    $sql = mysqli_query($con, "UPDATE users SET session_expiration='$newExpirationTime' WHERE id='$userID'");
    if(!$sql) die();
}

function generateNewSessionHash($userID){
    updateSessionTimeout($userID);
    $newHash = generateRandomString(20);
    global $con;
    $sql = mysqli_query($con, "UPDATE users SET session_hash='$newHash' WHERE id='$userID'");
    if(!$sql) die();

    return $newHash;
}


function getSessionHash($userID){

    global $con;
    $sql = mysqli_query($con, "SELECT session_hash FROM user WHERE telegram_uid='$userID'");
    if(!$sql) die();
    if (mysqli_num_rows($sql) == 1){
        $result = mysqli_fetch_assoc($sql);
        return $result['session_hash']; 
    }else{
        return '0';
    }
}

function isBanned($userID){

    global $con;
    $sql = mysqli_query($con, "SELECT is_banned FROM users WHERE id='$userID'");
    if(!$sql) die();
    $result = mysqli_fetch_array($sql);
    if($result['is_banned']){
        return true;
    }else{
        return false;
    }
    
}

function isValidateEmail($email) {
    
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function sanitizeData($data) {
    global $con;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($con, $data);
    return $data;
}


function logout(){
    session_destroy();
}


function hashData($data){
    $options = ['cost' => 12];
    return password_hash($data, PASSWORD_DEFAULT, $options);
}

function my_simple_crypt($string, $action) {
    // you may change these values to your own
    $secret_key = 'fay37udmdfiw1';
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

function getTimeStamp(){
    return date('Y-m-d H:i:s');
}


function adminRestricted(){
    global $con;
    $user=$_SESSION['uid'];
    $sql = mysqli_query($con, "SELECT is_admin FROM user WHERE telegram_uid='$user' AND is_banned='0'");
    if(!$sql) die();
    if(mysqli_num_rows($sql)!=1) die();
    
    $result = mysqli_fetch_array($sql);
    if(!$result['is_admin']){
        session_destroy();
        header('Location: login.php');
        die();
    }
}

function getEmailFromUserId($userid){
    global $con;
    $sql = mysqli_query($con, "SELECT email FROM users WHERE id='$userid'");
    if(!$sql) die();
    $result = mysqli_fetch_array($sql);
    return $result['email'];
}

function getMenu(){
    global $con;
    $menuArray = array();
    $sql = mysqli_query($con, "SELECT * FROM items WHERE is_available='1'");
    if(!$sql) die();

    while($result = mysqli_fetch_array($sql)){
        $nestedArray['id'] = $result['id'];
        $nestedArray['title'] = $result['title'];
        $nestedArray['description'] = $result['description'];
        $nestedArray['picture'] = $result['picture'];
        $nestedArray['price'] = $result['price'];
        $nestedArray['calories'] = $result['calories'];
        array_push($menuArray, $nestedArray);
    }
    $out = array_values($menuArray);
    die(json_encode($out));
}

function placeOrder($cart, $userID){
    global $con;
    $cartID = md5(uniqid(rand(), true));
    $totalPrice = 0.00;
    foreach($cart as $item) {
        $itemID = sanitizeData($item['item_id']);
        $qty = sanitizeData($item['quantity']);
        $price = getPrice($itemID);
        $sql = mysqli_query($con,"INSERT INTO carts (id, item_id, quantity, price_per_qty) VALUES ('$cartID', '$itemID', '$qty', '$price'");
        if(!$sql) die('Failed to add to cart');
        $totalPrice = $price * $qty;
    }
    $timestamp = getTimeStamp();
    $details = "INSERT DETAILS HERE";
    $sql = mysqli_query($con,"INSERT INTO transactions (user_id, details, amount, start_timestamp, status) VALUES ('$userID', '$details', '$totalPrice', '$timestamp', '0'");
    if(!$sql) die('Failed to insert trx');
    $trxID = $con->insert_id;

    $sql = mysqli_query($con,"INSERT INTO orders (cart_id, trx_id, placement_timestamp) VALUES ('$cartID', '$trxID', '$timestamp'");
    if(!$sql) die('Failed to insert Order');
    $orderID = $con->insert_id;

    $sql = mysqli_query($con,"INSERT INTO order_status (order_id, status, last_state_timestamp) VALUES ('$orderID', '0', '$timestamp'");
    if(!$sql) die('Failed to insert OrderStatus');

    $jsonArray['trxID'] = $trxID;
    $jsonArray['orderID'] = $orderID;
    $jsonArray['totalAmount'] = $totalPrice;
    $out = array_values($jsonArray);
    return json_encode($out);

}

function getPrice($itemID){
    global $con;
    $sql = mysqli_query($con, "SELECT price FROM items WHERE id='$itemID' AND is_available='1'");
    if(!$sql) die();
    if (mysqli_num_rows($sql) == 1){
        $result = mysqli_fetch_assoc($sql);
        return $result['price']; 
    }else{
        die('Item not available');
    }
}





?>