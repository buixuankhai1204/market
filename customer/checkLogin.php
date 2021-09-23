<?php 
session_start();
require_once '../myhelper.php';

$userName= $_POST['userName'];
$password= $_POST['password'];
$checkLogin= new checkLogin($userName,$password);
$checkLogin->checkLogin($checkLogin);


class checkLogin {

    private $userName;
    private $password;
    

    public function __construct($userName, $password)
    {

        $this->userName = $userName;
        $this->password = $password;

    }

    public function checkLogin(checkLogin $checkLogin)
    {
        $password_hash = md5($checkLogin->password);
        try {

            if ($checkLogin->userName === "" || $checkLogin->password === "") {
                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "lay du lieu khong lieu thanh cong",
                    "error" => true,
                ];
                echo json_encode($array_respone);

            }

            $query = "SELECT UserName,FullName,Password FROM customers WHERE UserName = $checkLogin->userName";
            $row = json_decode(responeCheckQuery($query));
            
            if ($row === []) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "data" => null,
                    "message" => "account not invalid",
                    "error" => false,
                ];
                echo json_encode($array_respone);

            } else {

                if ($password_hash != $row->data[0]->Password) {

                    $array_respone = [
                        "success" => false,
                        "status_code" => 100,
                        "data" => null,
                        "message" => "password incorrect",
                        "error" => false,
                    ];
                    echo json_encode($array_respone);

                } else {
                    $_SESSION['info_customer']['userName'] = $row->data[0]->userName;
                    $_SESSION['info_customer']['fullname'] = $row->data[0]->FullName;
                    $_SESSION['cart']['totalPrice'] = 0;
                    $_SESSION['cart']['product'] = [];
                    $array_respone = [
                        "success" => true,
                        "status_code" => 200,
                        "message" => "login success",
                        "error" => false,
                    ];

                    echo json_encode($array_respone);

                }
            
            }

        } catch (Exception $e) {
            
            $e->getMessage();
        }
        
    }
}
