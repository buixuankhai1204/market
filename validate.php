<?php

 function validateUserName($userName){
    $parttern = "/^[A-Za-z0-9_\.]{6,32}$/";
    if(!preg_match($parttern, $userName)){
        $respone = "userbame sai";
        return $respone;
    }
    return "";
 }

 function validatePassword($password){
    $parttern = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if(!preg_match($parttern, $password)){
        $respone = "cần nhập mật khẩu đúng định dạng";
        return $respone;
    }
    return "";
 }

 function validateEmail($email){
    $parttern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if(!preg_match($parttern, $email)){
        $respone = "cần nhập email đúng định dạng";
        return $respone;
    }
    return "";
 }

 function validatePhoneNumber($phone_number){
    $data = '+11234567890';
    if(!preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $data,  $matches ) )
    {
        $respone = "xin nhập số điện thoại đúng định dạng";
        return $respone;
    }
    else
    {
        $phone_number = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
        return $phone_number;
    }
 }
?>