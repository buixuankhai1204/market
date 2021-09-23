<?php

 function validateUserName($userName){
    $parttern = "/^[A-Za-z0-9_\.]{6,32}$/";
    if(!preg_match($parttern, $userName)){
        $respone = "userbame sai";
        return $respone;
    }
    return "";
 }
?>