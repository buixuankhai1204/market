<?php 
session_start();
require_once '../myhelper.php';

$userName= $_POST['userName'];
$password= $_POST['password'];
$checkLogin= new checkLogin($userName,$password);
$checkLogin->checkLogin($checkLogin);


class checkLogin {

    public $userName;
    public $password;
    

    public function __construct($userName, $password)
    {

        $this->userName = $userName;
        $this->password = $password;

    }

    public function checkLogin(checkLogin $checkLogin)
    {
        $error_code = array();
        try {
            if ($checkLogin->userName === "" || $checkLogin->password === "") {
                $error_code['user'] = "tài khoản hoặc mật khẩu không được để trống";
            }
            else{
                $check = checkPassword($checkLogin->userName,$checkLogin->password);
                print_r($check);
                // echo json_encode($check);
                if($check['success'] == true){
                    $array_repone = [
                        "success" => true,
                        "status_code" => 200,
                        "message" => "Dn thanh cong",
                        "error" => false,
                    ];
                    echo json_encode($array_repone);
                } else {
                    $array_repone = [
                        "success" => false,
                        "status_code" => 400,
                        "message" => $check['message'],
                        "error" => false,
                    ];
                    echo json_encode($array_repone); 
                }
            }
        } catch (Exception $e) {
            
            $e->getMessage();
        }
        
    }
}
