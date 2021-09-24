<?php
include_once '../myhelper.php';
include_once '../class/user.php';

$userName = $_POST['userName'];
$fullName = $_POST['fullname'];
$password = $_POST['password'];
$address = $_POST['address'];
$birthday = $_POST['birthday'];
$phone_number = $_POST['phone_number'];
$userID = random_int(100,1000000);

$customer= new user($userID, $userName, $fullName, $password, $address, $phone_number, $birthday);
$customer->addCustomer($customer);

$_SESSION['info_customer']["userName"] = $userName;
$_SESSION['info_customer']["fullname"] = $fullName;
$_SESSION['cart']['totalPrice'] = 0;
$_SESSION['cart']['product'] = [];
?>
