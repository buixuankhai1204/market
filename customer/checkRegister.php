<?php
session_start();
require_once '../myhelper.php';
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

            if($checkRegister->userName === "" || $checkRegister->fullName === "" || $checkRegister->password === "" || $checkRegister->address === "" || $checkRegister->phone_number === "" || $checkRegister->birthday === "" || $checkRegister->created_at ==="" || $checkRegister->updated_at === "" || $checkRegister -> active_status === ""){
                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "xin điền đầy đủ thông tin",
                    "error" => true,
                ];
                echo json_encode($array_respone);
            }
            else{
                $parttern = "/^[A-Za-z0-9_\.]{6,32}$/";
                if(!preg_match($parttern, $_POST['userName'])){
                    $array_respone = [
                        "success" => false,
                        "status_code" => 100,
                        "message" => "xin nhập tài khoản đúng định dạng",
                        "error" => true,
                    ];
                    echo json_encode($array_respone);
                }
                
                $parttern1 = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                if(!preg_match($parttern1, $_POST['password'])){
                    $array_respone = [
                        "success" => false,
                        "status_code" => 100,
                        "message" => "xin nhập ,ật khẩu đúng định dạng",
                        "error" => true,
                    ];
                    echo json_encode($array_respone);
                }
                
                $parttern2 = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
                if(!preg_match($parttern2, $_POST['password'])){
                    $array_respone = [
                        "success" => false,
                        "status_code" => 100,
                        "message" => "xin nhập email đúng định dạng",
                        "error" => true,
                    ];
                    echo json_encode($array_respone);
                }
                
                $data = '+11234567890';
                if(!preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $data,  $matches ) )
                {
                    $array_respone = [
                        "success" => false,
                        "status_code" => 100,
                        "message" => "xin nhập số điện thoại đúng định dạng",
                        "error" => true,
                    ];
                    echo json_encode($array_respone);
                }
                else{
                    $result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
                    return $result;
                }
            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}


