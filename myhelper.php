<?php
include_once 'connection.php';
function responeCheckQuery($query)
{
    if (!$result = mysqli_query(connection(), $query)) {
        $array_respone = [
            "success" => false,
            "data" => null,
            "message" => "lấy dữ liệu không thành công",
            "error" => true,
        ];
        return json_encode($array_respone);
    }

    $list = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $list[] = $row;
        }
    }

    $array_respone = [
        "success" => true,
        "data" => $list,
        "message" => "lấy dữ liệu thành công",
        "error" => false,
    ];
    return json_encode($array_respone);
}

function responeField($field)
{
    if (!$result = mysqli_query(connection(), $field)) {
        mysqli_error(connection());
    }

    if ($result) {
        $respone = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_row($result)) {
                $respone[] = $row;
            }
        }

        return $respone;
    }
}

function getPasswordHash($userName, $password){
    $usernameHash = md5($userName);
    $passwordHash = $usernameHash.md5($password);
    return $passwordHash; 
}

function checkPassword($userName,$password){
    $passwordHash = getPasswordHash($userName,$password);
    $query = "SELECT * FROM users WHERE userName = '$userName'";
    $row = json_decode(responeCheckQuery($query));
    // print_r($row);
    $respone = "";
    if($row->success === false){
        $respone = "account not invalid";
    }
    else
    {
        if($passwordHash != $row->data[0] -> password){
            $respone = "password incorrect";
        }  
        else{
            $_SESSION['info_customer']['userName'] = $row->data[0]->userName;
            $_SESSION['info_customer']['fullname'] = $row->data[0]->FullName;
        }
    }
    if(!$respone == ""){
        $array_respone = [
            "success" => false,
            "message" => $respone,
        ];
        return $array_respone;
    }
    else{
        $array_respone = [
            "success" => true,
            "message" => "",
        ];
        return $array_respone;
    }
}
//nhin ra van de chua 
//tan dung cai success do de check chu Khoa oke
//oke xong roi, doi t day code len 
//m push code len di
