<?php
require_once '../myhelper.php';
class customer
{
    // Properties
    public $userName;
    public $fullName;
    public $password;
    public $email;
    public $phone_number;
    public $birthday;
    public $address;
    public $created_at;
    public $updated_at;
    public $active_status;

    public function __construct($userName,$fullName, $password, $phone_number, $birthday, $address, $created_at, $updated_at, $active_status)
    {
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

    public function getCustomerById($customerId)
    {

        try {

            if ($customerId == "") {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);

            }

            $query = "SELECT * FROM customers WHERE CustomerID = $customerId";
            echo responeCheckQuery($query);

        } catch (Exception $e) {

            $e->getMessage();

        }
    }

    public function addCustomer(customer $customer)
    {
        try {

            if (
                $customer->fullName === ''
                || $customer->password === ''
                || $customer->address === ''
                || $customer->city === ''
            ) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                return json_encode($array_respone);

            }
            // $customer->password, $customer->fullName , $customer->address, $customer->city
            $query = sprintf("INSERT INTO customers ( CustomerID, FullName, password, address, city) VALUES (%s,'%s','%s','%s','%s')",$customer->customerId, $customer->fullName, md5($customer->password), $customer->address, $customer->city);
            if (!$result = mysqli_query(connection(), $query)) {

                mysqli_error(connection());

            }
            if ($result) {

                $customer->getCustomerById($customer->customerId);

            } else {

                mysqli_error(connection());

            }
        } catch (Exception $e) {

            $e->getMessage();
            
        }
    }
}
