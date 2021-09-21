<?php
require_once '../myhelper.php';
class category
{
    // Properties
    public $categoryId;
    public $name;
    public $description;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function getAllCategory()
    {

        try {

            $query = "SELECT * FROM category";
            return json_decode(responeCheckQuery($query));

        } catch (Exception $e) {

            $e->getMessage();

        }
    }

    public function addCcategory(category $category)
    {
        try {

            if (
                $category->name === ''
                || $category->description === ''
            ) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);

            }
            // $customer->password, $customer->fullName , $customer->address, $customer->city
            $query = sprintf("INSERT INTO category ( Name, Description) VALUES ('%s','%s')", $category->name, $category->description);
            if (!$result = mysqli_query(connection(), $query)) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                return $array_respone;      

            }

            if ($result) {

                $queryNew = "SELECT * FROM category";
                return json_decode(responeCheckQuery($queryNew));

            } else {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                return $array_respone;

            }

        } catch (Exception $e) {

            $e->getMessage();
            
        }
    }
}
