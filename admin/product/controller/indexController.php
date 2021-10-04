<?php 
    require('../model/indexModel.php');
    $userId = 843575;
    $categoryId = $_POST['categoryId'];
    $productName = $_POST['productName'];
    $decription = $_POST['decription'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $isActive = $_POST['isActive'];
    $image = $_FILES['uploadFile']['name'];
    if(isset($_POST['addProduct'])){
        $product = new Product($categoryId,$userId,$productName,$decription,$image,$price,$size,$isActive);
        $product->addProduct($product);
        print_r($product);
    }
?>