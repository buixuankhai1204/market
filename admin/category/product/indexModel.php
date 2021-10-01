<?php 

    include_once 'myhelper.php';

    class category {
        public $catogoryId;
        public $userId;
        public $categoryName;
        public $parentId;

    public function __construct($userId, $categoryName, $parentId)
    {
        $this->userId = $userId;
        $this->categoryName = $categoryName;
        $this->parentId = $parentId;
    }

    public function addCategory(category $category)
    {
        try {

            if (
                $category->catogoryId === ''
                || $category->userId === ''
                || $category->categoryName ===''
                || $category->parentId ===''
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
            $query = sprintf("INSERT INTO categories (userId, categoryName, parentId) VALUES (%s,'%s',%s)", $category->userId, $category->categoryName, $category->parentId);
            echo $query;
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

    public function getParentCategory(){
        $query = "SELECT * FROM categories WHERE 'parentId' = 0";
        return json_decode(responeCheckQuery($query));

    }

}

    //function ///
?>