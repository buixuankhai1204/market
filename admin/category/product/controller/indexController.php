<?php

    include_once '../model/indexModel.php';

    if(isset($_POST['addCat'])) {
        $parenId = $_POST['parentId'];
        $categoryName = $_POST['categoryName'];
        $userId = 2134;
        $category = new category($userId,$categoryName,$parenId);
        echo $category->addCategory($category);
    }

?>