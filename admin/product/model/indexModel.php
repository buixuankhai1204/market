<?php 
    include_once '../../../myhelper.php';
    class product {
        public $productId;
        public $categoryId;
        public $userId;
        public $productName;
        public $decription;
        public $image;
        public $price;
        public $size;
        public $status;
        public $isActive;

        public function __construct($categoryId, $userId, $productName, $decription, $image, $price, $size, $isActive)
        {
            $this->userId = $userId;
            $this->categoryId = $categoryId;
            $this->productName = $productName;
            $this->decription = $decription;
            $this->image = $image;
            $this->price = $price;
            $this->size = $size;
            $this->isActive = $isActive;
        }

        public function addProduct(product $product)
    {
        try {
            $error_code = array();
            if (
                $product->categoryId === ''
                || $product->productName === ''
                || $product->image ===''
                || $product->decription ===''
                || $product->price ===''
                || $product->size ===''
                || $product->isActive ===''
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
            $query = sprintf("INSERT INTO product (categoryId, userId, productName, image, decription, size, price) VALUES (%s,%s,'%s','%s','%s',%s,%s)", $product->categoryId, $product->userId, $product->productName, $product->image, $product->decription, $product->size, $product->price);
            echo $query;
            if (!$result = mysqli_query(connection(), $query)) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);      
            }

            if(validatePrice($_POST['price']) != ""){
                $error_code['price'] = validatePassword($_POST['price']);
            }
            if(count($error_code) > 0){
                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => $error_code,
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
}
    //function ///
?>