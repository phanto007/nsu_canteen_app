<?php
/*
    Author: Walletmix Ltd.
    Version: 2.5.4.17
    Title: Walletmix Payment Gateway Integration (data submission)
    Email: support@walletmix.com
 
*/
include 'includes/connect.php';
include 'includes/wallet.php';

if($_SESSION['customer_sid']==session_id())
{
    if(!isset($_POST['deposit']))
    {
        die();
    }



    $user_id = $_SESSION['user_id'];

    $result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
    $row = mysqli_fetch_array($result);

    $amount = htmlspecialchars($_POST['deposit']);

    $name = $row['name'];
    $email = $row['email'];   
    $address = $row['address'];
    $city = $row['city'];
    $country = $row['country'];
    $postcode = $row['address'];
    $phone = $row['phone'];

    $sql = "INSERT INTO deposits (customer_id, amount) VALUES ('$user_id', '$amount');";
    $con->query($sql);
    $order_id =  $con->insert_id;

    include ('walletmix.php');


    $access_username = "tanvirbux_1333650400";
    $access_password = "tanvirbux_1961838250";
    $merchant_id = "WMX5bfe87b60d01c";
    $access_app_key = "b1135c5cb9c7321275be6ec1cde4df9c9dab19e7";

    $walletmix = NEW walletmix($access_username, $access_password, $merchant_id, $access_app_key);
     
    $customer_info = array(
        "customer_name"     => $name,
        "customer_email"    => $email,
        "customer_add"      => $address,
        "customer_city"     => $city,
        "customer_country"  => $country,
        "customer_postcode" => $postcode,
        "customer_phone"    => $phone,
    );
    $shipping_info = array(
        "shipping_name" => "NSU",
        "shipping_add" => "BASHUNDHARA",
        "shipping_city" => "DHAKA",
        "shipping_country" => "BANGLADESH",
        "shipping_postCode" => "1229",
    );
    $walletmix->set_shipping_charge(0);
    $walletmix->set_discount(0);
     
    $product_1 = array('name' => 'NSU Canteen Balance Top Up','price' => $amount,'quantity' => 1);
     
    $products = array($product_1);
     
    $walletmix->set_product_description($products);
    
    $walletmix->set_merchant_order_id($order_id);
     
    $walletmix->set_app_name('nsu.ddns.net/');
    $walletmix->set_currency('BDT');
    $walletmix->set_callback_url('http://nsu.ddns.net/nsu/');
    
    $extra_data = array();
     
    //if you want to send extra data then use this way
    //$extra_data = array('param_1' => 'data_1','param_2' => 'data_2','param_3' => 'data_3');
     
    $walletmix->set_extra_json($extra_data);
     
    $walletmix->set_transaction_related_params($customer_info);
    $walletmix->set_transaction_related_params($shipping_info);
     
    $walletmix->set_database_driver('session'); // options: "txt" or "session"
     
    $walletmix->send_data_to_walletmix();

}else{
    header("location:login.php");
}
 
?>
