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
            $error_code = array();
            if($checkRegister->userName === "" || $checkRegister->fullName === "" || $checkRegister->password === "" || $checkRegister->address === "" || $checkRegister->phone_number === "" || $checkRegister->birthday === "" || $checkRegister->created_at ==="" || $checkRegister->updated_at === "" || $checkRegister -> active_status === ""){
                $error_register = "xin nhập đầy đủ tất cả thông tin";

                $error_code = array(
                    "message" => $error_register,
                );
                echo json_encode($error_code);
            }
            else{
                $parttern = "/^[A-Za-z0-9_\.]{6,32}$/";
                if(!preg_match($parttern, $_POST['userName'])){
                    $error_userName = "xin nhập tài khoản đúng định dạng";
                    $error_code = array(
                        "username" => $error_userName,
                    );
                    echo json_encode($error_code);
                }
                
                $parttern1 = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                if(!preg_match($parttern1, $_POST['password'])){
                    $error_password = "xin nhập mật khẩu đúng định dạng";
                    $error_code = array(
                        "message" => $error_password,
                    );
                    echo json_encode($error_code);
                } else{ // tạo mật khẩu
                    $password_hash = md5($checkRegister->password);
                    $query = "SELECT UserName,FullName,Password FROM customers WHERE UserName = $checkRegister->userName";
                    $row = json_decode(responeCheckQuery($query));
                    if($password_hash == $row -> data[0] ->password){
                        $_SESSION['info_customer']['userName'] = $row->data[0]->userName;
                        $_SESSION['info_customer']['fullname'] = $row->data[0]->FullName;
                    }
                }
                
                $parttern2 = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
                if(!preg_match($parttern2, $_POST['password'])){
                    $error_password = "xin nhập email đúng định dạng";
                    $error_code = array(
                        "message" => $error_password,
                    );
                    echo json_encode($error_code);
                }
                // viet ham trong myhelper  2 tham so dau vao la username va password, xu ly va trar ve hash password
                $data = '+11234567890';
                if(!preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $data,  $matches ) )
                {
                    $error_sdt = "xin nhập mật khẩu đúng định dạng";
                    $error_code = array(
                        "message" => $error_sdt,
                    );
                    echo json_encode($error_code);
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


