<?php
require_once '../myhelper.php';
class user
{
    // Properties
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

    public function getCustomerById($userName)
    {

        try {

            if ($userName == "") {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);

            }

            $query = "SELECT * FROM customers WHERE CustomerID = $userName";
            echo responeCheckQuery($query);

        } catch (Exception $e) {

            $e->getMessage();

        }
    }

    public function addCustomer(User $user)
    {
        try {
            $error_code = array();
            if($user->userName === "" || $user->fullName === "" || $user->password === "" || $user->address === "" || $user->phone_number === "" || $user->birthday === "" || $user->created_at ==="" || $user->updated_at === "" || $user -> active_status === ""){
                $error_register = "xin nhập đầy đủ tất cả thông tin";

                $error_code['user'] = $error_register;
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
                    $passwordHash = getPasswordHash($user->userName, $user->password);
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
            
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
