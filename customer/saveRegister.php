<?php
include_once '../myhelper.php';
include_once '../class/customer.php';
session_start();

$fullName = $_POST['fullname'];
$password = $_POST['password'];
$address = $_POST['address'];
$city = $_POST['city'];
$customerId = random_int(100,1000000);

$customer= new customer($customerId, $fullName, $password, $address, $city);
$customer->addCustomer($customer);

$_SESSION['info_customer']["customerId"] = $customerId;
$_SESSION['info_customer']["fullname"] = $fullName;
$_SESSION['cart']['totalPrice'] = 0;
$_SESSION['cart']['product'] = [];
?>
