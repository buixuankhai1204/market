<?php
include_once 'indexModel.php';
    $parenId = $_POST['parentId'];
    $categoryName = $_POST['categoryName'];
    $userId = 843575;
    $category = new category($userId,$categoryName,$parenId);
    $category->addCategory($category);
?>