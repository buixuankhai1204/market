<?php
session_start();
require_once '../myhelper.php';
require_once '../validate.php';
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
            $error_code = array();
            if($checkRegister->userName === "" || $checkRegister->fullName === "" || $checkRegister->password === "" || $checkRegister->address === "" || $checkRegister->phone_number === "" || $checkRegister->birthday === "" || $checkRegister->created_at ==="" || $checkRegister->updated_at === "" || $checkRegister -> active_status === ""){
                $error_register = "xin nhập đầy đủ tất cả thông tin";

                $error_code['checkRegister'] = $error_register;
            }
            else{
                
                $error_code['userName'] = validateUserName($_POST['userName']);

                $parttern1 = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                if(!preg_match($parttern1, $_POST['password'])){
                    $error_code = array(
                        $error_code['password'] => "xin nhập mật khẩu đúng định dạng",
                    );
                }
                $parttern2 = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
                if(!preg_match($parttern2, $_POST['email'])){
                    $error_password = "xin nhập email đúng định dạng";
                    $error_code = array(
                        $error_code['email'] => $error_password,
                    );
                }
                // viet ham trong myhelper  2 tham so dau vao la username va password, xu ly va trar ve hash password
                $data = '+11234567890';
                if(!preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $data,  $matches ) )
                {
                    $error_code = array(
                        $error_code['phone_number'] => "xin nhập số điện thoại đúng định dạng",
                    );
                    echo json_encode($error_code);
                }
                else{
                    $result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
                    return $result;
                }

                if(isset($error_code)){
                    $array_respone = array(
                        "message" => $error_code,
                    );
                }else{
                    $passwordHash = checkPasswordHash($checkRegister->userName, $checkRegister->password);
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


