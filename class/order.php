<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../myhelper.php';
require_once 'vegetable.php';
require_once 'orderdetail.php';

if(isset($_POST['orderId'])){
    $order = new order(0,'',0,'');
    echo $order->getOrderDetailByOrderId($_POST['orderId']);
}
class order
{
    // Properties
    public $orderId;
    public $customerId;
    public $date;
    public $total;
    public $note;

     
    public function __construct($customerId, $date, $total, $note)
    {
        $this->customerId = $customerId;
        $this->date = $date;
        $this->total = $total;
        $this->note = $note;
    }

    public function getAllVegestable()
    {

        try {

            $query = "SELECT * FROM vegetable LIMIT 20;";
            return json_decode(responeCheckQuery($query));

        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function getAllOrderByCustomerId($customerId)
    {
        try {

            if ($customerId <= 0) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);

            }

            $query = "SELECT * FROM orders WHERE CustomerID = $customerId;";
            return json_decode(responeCheckQuery($query));

        } catch (Exception $e) {

            $e->getMessage();

        }
    }

    public function getOrderDetailByOrderId($orderId)
    {
        try {

            if ($orderId <= 0) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);
            }

            $query = "SELECT * FROM orderdetail WHERE OrderID = $orderId;";
            return responeCheckQuery($query);

        } catch (Exception $e) {

            $e->getMessage();

        }
    }

    public function addOrder(order $order, $orderDetails = [] )
    {

        try {

            if (
                $order->customerId === ''
                || $order->date === ''
                || $order->total === ''
            ) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);

            }

            $customerId = $_SESSION['info_customer']['customerId'];
            $query = sprintf("INSERT INTO orders ( CustomerID, Date, Total, Note) VALUES (%s,'%s',%s,'%s')", $customerId, $order->date, $order->total, $order->note);
            
            if (!mysqli_query(connection(), $query)) {
                
                $array_respone = [
                    "success" => 100,
                    "data" => null,
                    "message" => "thêm dữ liệu không thành công",
                    "error" => true,
                ];
                echo json_encode($array_respone);
                
            }

            $query = "SELECT * FROM orders WHERE CustomerID = $customerId  ORDER BY OrderID DESC LIMIT 1";
            $result = responeCheckQuery($query);
            $result = json_decode($result);
            $orderId = $result->data[0]->OrderID;

            // add cart detail
            foreach ($orderDetails as $orderdetail) {

                $query = sprintf("INSERT INTO orderdetail (OrderID, VegetableID, Quantity, Price , name , picture) VALUES (%s,%s,%s,%s,'%s','%s')",$orderId, $orderdetail->vegetableId, $orderdetail->quantity, $orderdetail->price, $orderdetail->name, $orderdetail->picture);
                if (!mysqli_query(connection(), $query)) {

                    $array_respone = [
                        "success" => 100,
                        "data" => null,
                        "message" => "thêm dữ liệu không thành công",
                        "error" => true,
                    ];
                    echo json_encode($array_respone);

                }
            }

            $array_respone = [
                "success" => 200,
                "data" => null,
                "message" => "thêm dữ liệu thành công",
                "error" => true,
            ];
            echo json_encode($array_respone);
            
        } catch (Exception $e) {

            $e->getMessage();
            
        }
    }
}

