
<?php
require_once '../myhelper.php';
require_once '../validate.php';



class user
{
    // Properties
    private $userID;
    private $userName;
    private $fullName;
    private $password;
    private $address;
    private $birthday;
    private $phone_number;
    private $created_at;
    private $updated_at;
    private $active_status;

    public function __construct($userID,$userName,$fullName,$password,$address,$phone_number,$birthday){
        $this->userID = $userID;
        $this->userName = $userName;
        $this->fullName = $fullName;
        $this->password = $password;
        $this->address = $address;
        $this->phone_number = $phone_number;
        $this->birthday = $birthday;

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
            if($user->userName === "" || $user->fullName === "" || $user->password === "" || $user->address === "" || $user->phone_number === "" || $user->birthday === ""){

                $error_code['user'] = "xin nhập đầy đủ tất cả thông tin";
            }
            else{
                if (validateUserName($_POST['userName']) != ""){
                $error_code['userName'] = validateUserName($_POST['userName']);

                }
                if (validatePassword($_POST['password']) != ""){
                $error_code['password'] = validatePassword($_POST['password']);
                }
                // $error_code['phone_number'] = validatePhoneNumber($_POST['phone_number']);
                // van de la , "" nay no cung la loi, gio minh xu ly sao cho, khong co loi thi khong co key , no moi thoat dc $errror_code
                //hieu y t khong ?um
                //hieu chua khoa um chay thu di
                // sure la dc
                 // :D
                if(count($error_code)  > 0){
                    $array_respone = array(
                        "success" => false,
                        "status_code" => 100,
                        "message" => $error_code,
                        "error" => false,
                    );
                    echo json_encode($array_respone);
                } else {
                    $passwordHash = getPasswordHash($user->userName, $user->password);
                   
                    $query = sprintf("INSERT INTO users ( userId, userName, fullName, password, address, birthday) VALUE (%s,'%s','%s','%s','%s','%s')", $user->userID, $user->userName, $user->fullName, $passwordHash, $user->address, $user->birthday);
                    echo $query;
                    if(!$result = mysqli_query(connection(), $query)){
                        echo mysqli_error(connection());
                    }
                    else{
                        $array_respone = [
                            "success" => true,
                            "data" => null,
                            "message" => "thêm người dùng thành công thành công",
                            "error" => true,
                        ];
                        echo json_encode($array_respone);
                    }
                }
            }
            
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
