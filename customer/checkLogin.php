<?php 
session_start();
require_once '../myhelper.php';

$customerId= $_POST['customerId'];
$password= $_POST['password'];
$checkLogin= new checkLogin($customerId,$password);
$checkLogin->checkLogin($checkLogin);


class checkLogin {

    private $customerId;
    private $password;
    

    public function __construct($customerId, $password)
    {

        $this->customerId = $customerId;
        $this->password = $password;

    }

    public function checkLogin(checkLogin $checkLogin)
    {
        $password_hash = md5($checkLogin->password);
        try {

            if ($checkLogin->customerId === "" || $checkLogin->password === "") {
                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "lay du lieu khong lieu thanh cong",
                    "error" => true,
                ];
                echo json_encode($array_respone);

            }

            $query = "SELECT CustomerID,FullName,Password FROM customers WHERE CustomerID = $checkLogin->customerId";
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
                    
                    $_SESSION['info_customer']['customerId'] = $row->data[0]->CustomerID;
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
