<?php
require_once '../myhelper.php';
class customer
{
    // Properties
    public $customerId;
    public $fullName;
    public $password;
    public $address;
    public $city;

    public function __construct($customerId, $fullName, $password, $address, $city)
    {

        $this->customerId = $customerId;
        $this->fullName = $fullName;
        $this->password = $password;
        $this->address = $address;
        $this->city = $city;

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
