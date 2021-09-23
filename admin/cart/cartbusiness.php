<?php
require_once '../class/vegetable.php';
session_start();

//  $_POST['id'],$_POST['name'],$_POST['picture'],$_POST['amount'],$_POST['price'],
$id = intval($_POST['id']);
addcart($id);

function getAllCart()
{

  if (isset($POST['cart'])) {

    $array_respone = [
      "success" => true,
      "status_code" => 200,
      "data" => $_SESSION['cart']['product'],
      "message" => "lấy thành công giỏ hàng",
      "error" => false,
    ];
    return json_encode($array_respone);

  } else {

    $array_respone = [
      "success" => false,
      "status_code" => 100,
      "data" => $_SESSION['cart']['product'],
      "message" => "lấy giỏ hàng khoong thành công",
      "error" => true,
    ];
    return json_encode($array_respone);

  }
}

function addcart($id)
{

  // kiểm tra sản phẩm đã có trong giỏ hàng hay chưa 
  if (isset($_SESSION['cart']['product'][$id]) == true) {

    $_SESSION['cart']['product'][$id]['amount']++;
    //thiet lap lai cai san pham do trong gio hang
    $_SESSION['cart']['product'][$id] = array(
      "amount" => $_SESSION['cart']['product'][$id]['amount'],
      "price" => $_POST['price'] * $_SESSION['cart']['product'][$id]['amount']
    );

    $total = $_SESSION['cart']['totalPrice'];

    $_SESSION['cart']['totalPrice'] = $total + $_POST['price'];

    //theem thông tin sản phẩm 1 lan nua 
    $_SESSION['cart']['product'][$id] = array(
      "id" => $_POST['id'],
      "name" => $_POST['name'],
      "amount" => $_SESSION['cart']['product'][$id]['amount'],
      "price" => $_SESSION['cart']['product'][$id]['price'],
      "picture" => $_POST['picture'],
    );
    
    $array_respone = [
      "success" => true,
      "status_code" => 200,
      "data" => $_SESSION['cart']['product'][$id],
      "message" => "đã thêm vào giỏ hàng thành công",
      "error" => false,
    ];
    echo json_encode($array_respone);

  } else {

    $_SESSION['cart']['product'][$id] = array(
      "amount" => 1,
      "price" => $_POST['price']
    );
    
    $_SESSION['cart']['totalPrice'] = $_SESSION['cart']['totalPrice'] + $_SESSION['cart']['product'][$id]['price'];
    //theem thông tin sản phẩm
    $_SESSION['cart']['product'][$id] = array(
      "id" => $_POST['id'],
      "name" => $_POST['name'],
      "amount" => $_SESSION['cart']['product'][$id]['amount'],
      "price" => $_POST['price'],
      "picture" => $_POST['picture'],
    );

    $array_respone = [
      "success" => true,
      "status_code" => 100,
      "data" => $_SESSION['cart']['product'][$id],
      "message" => "đã thêm vào giỏ hàng thành công",
      "error" => false,
    ];
    echo json_encode($array_respone);

  }
}

