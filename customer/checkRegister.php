<?php
session_start();
require_once '../myhelper.php';
require_once '../validate.php';
include_once '../class/customer.php';
$userName = $_POST['userName'];
$fullName = $_POST['fullname'];
$password = $_POST['password'];
$address = $_POST['address'];
$birthday = $_POST['birthday'];
$phone_number = $_POST['phone_number'];
$created_at = $_POST['created_at'];
$updated_at = $_POST['updated_at'];
$active_status = $_POST['active_status'];
$checkRegister = new checkRegister($userName,$fullName,$password,$address,$phone_number,$birthday,$created_at,$updated_at,$active_status);
$checkRegister->checkRegister($checkRegister);
$customer = new customer($userName,$fullName,$password,$address,$phone_number,$birthday,$created_at,$updated_at,$active_status);

class checkRegister {
    private $userName;
    private $fullName;
    private $password;
    private $address;
    private $birthday;
    private $phone_number;
    private $created_at;
    private $updated_at;
    private $active_status;

    public function __construct($userName,$fullName,$password,$address,$phone_number,$birthday,$created_at,$updated_at,$active_status){
        $this->userName = $userName;
        $this->fullName = $fullName;
        $this->password = $password;
        $this->address = $address;
        $this->phone_number = $phone_number;
        $this->birthday = $birthday;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->active_status = $active_status;
    }

    public function checkRegister(checkRegister $checkRegister){
        try {
            $error_code = array();
            if($checkRegister->userName === "" || $checkRegister->fullName === "" || $checkRegister->password === "" || $checkRegister->address === "" || $checkRegister->phone_number === "" || $checkRegister->birthday === "" || $checkRegister->created_at ==="" || $checkRegister->updated_at === "" || $checkRegister -> active_status === ""){
                $error_register = "xin nhập đầy đủ tất cả thông tin";

                $error_code['checkRegister'] = $error_register;
            }
            else{
                $error_code['userName'] = validateUserName($_POST['userName']);

                $error_code['password'] = validatePassword($_POST['password']);
                
                $error_code['email'] = validateEmail($_POST['email']);
                
                $error_code['phone_number'] = validatePhoneNumber($_POST['phone_number']);

                if(isset($error_code)){
                    $array_respone = array(
                        "success" => false,
                        "status_code" => 100,
                        "message" => $error_code,
                        "error" => false,
                    );
                    return $array_respone;
                }else{
                    $passwordHash = getPasswordHash($checkRegister->userName, $checkRegister->password);
                    if($passwordHash){
                        $array_respone = [
                            "success" => true,
                            "status_code" => 200,
                            "error" => false,
                        ];
                        echo json_encode($array_respone);
                    }
                }
            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}


