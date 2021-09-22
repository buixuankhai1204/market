<?php
include_once '../myhelper.php';
include_once '../class/customer.php';
session_start();

$userName = $_POST['userName'];
$fullName = $_POST['fullname'];
$password = $_POST['password'];
$address = $_POST['address'];
$birthday = $_POST['birthday'];
$phone_number = $_POST['phone_number'];
$created_at = $_POST['created_at'];
$updated_at = $_POST['updated_at'];
$active_status = $_POST['active_status'];
$userName = random_int(100,1000000);

$customer= new customer($userName, $fullName, $password, $address, $phone_number, $birthday, $created_at, $updated_at, $active_status);
$customer->addCustomer($customer);

$_SESSION['info_customer']["userName"] = $userName;
$_SESSION['info_customer']["fullname"] = $fullName;
$_SESSION['cart']['totalPrice'] = 0;
$_SESSION['cart']['product'] = [];
?>
