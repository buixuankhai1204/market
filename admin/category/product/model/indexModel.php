<?php 
    include_once '../../../myhelper.php';
    class category {
        public $catogoryId;
        public $userId;
        public $categoryName;
        public $parentId;

    public function __construct($userId, $categoryName, $parentId)
    {
        $this->userId = $userId;
        $this->categoryName = $categoryName;
        $this->parentId = $parentId;đâsd
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

            if (!$result = mysqli_query(connection(), $query)) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);      

            }

                $array_respone = [
                    "success" => true,
                    "status_code" => 200,
                    "message" => "ban da them thanh cong danh muc ",
                    "error" => "",
                ];
                echo json_encode($array_respone);      


        } catch (Exception $e) {

            $e->getMessage();
            
        }
    }

    public function getParentCategory(){
        $query = "SELECT * FROM categories WHERE parentId = 0";
        return json_decode(responeCheckQuery($query));

    }

    public function getAllCategory(){
        $query = "SELECT * FROM categories";
        return json_decode(responeCheckQuery($query),true);
    }

}

    //function ///
