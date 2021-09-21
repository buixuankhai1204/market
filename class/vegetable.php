<?php

require_once '../myhelper.php';

if (isset($_POST['submit'])) {

    $target_dir = "/opt/lampp/htdocs/market/css/images/";
    $target_file = $target_dir . basename($_FILES['file_img']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES['file_img']["tmp_name"]);

    if ($check !== false) {

        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;

    } else {

        echo "File is not an image.";
        $uploadOk = 0;

    }
    if (file_exists($target_file)) {

        echo "Sorry, file already exists.";
        $uploadOk = 0;

      }
      
      if ($_FILES["file_img"]["size"] > 500000) {

        echo "Sorry, your file is too large.";
        $uploadOk = 0;

      }
      
      if($imageFileType != "jpg"
       && $imageFileType != "png"
       && $imageFileType != "jpeg"
       && $imageFileType != "gif" ) {

        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;

      }
      
      if ($uploadOk == 0) {

        echo "Sorry, your file was not uploaded.";

      } else {

        if (move_uploaded_file($_FILES["file_img"]["tmp_name"], $target_file)) {

          echo "The file ". htmlspecialchars( basename( $_FILES["file_img"]["name"])). " has been uploaded.";

        } else {

          echo "upload failed";

        }
      }

    $vegetable = new vegetable($_POST['categoryId'], $_POST['vegetableName'], $_POST['unit'], $_POST['amout'],  $_FILES["file_img"]["name"], $_POST['price']);
    $vegetable->addVegetable($vegetable);
}

class vegetable
{
    // Properties
    public $categoryId;
    public $vegetableName;
    public $unit;
    public $amount;
    public $image;
    public $price;

    public function __construct($categoryId, $vegetableName, $unit, $amount, $image, $price)
    {
        $this->categoryId = $categoryId;
        $this->vegetableName = $vegetableName;
        $this->unit = $unit;
        $this->amount = $amount;
        $this->image = $image;
        $this->price = $price;
    }
    public function addVegetable(vegetable $vegetable)
    {
        try {

            if (
                $vegetable->categoryId === ''
                || $vegetable->vegetableName === ''
                || $vegetable->amount === ''
                || $vegetable->image === ''
                || $vegetable->price === ''
            ) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                return json_encode($array_respone);

            }
            // $vegetable->password, $vegetable->fullName , $vegetable->address, $vegetable->city
            $query = sprintf("INSERT INTO vegetable ( CategoryID, VegetableName, Unit, Amount, Image, Price) VALUES (%s,'%s','%s', %s,'%s', %s)", $vegetable->categoryId, $vegetable->vegetableName, $vegetable->unit, $vegetable->amount, $vegetable->image, $vegetable->price);
            echo $query;
            if (!$result = mysqli_query(connection(), $query)) {

                echo mysqli_error(connection());

            } else {

                header('Location: http://localhost/market/vegetable/index.php');

            }

        } catch (Exception $e) {

            $e->getMessage();

        }
    }
    public function getAllVegetable()
    {

        try {

            $query = "SELECT * FROM vegetable LIMIT 20;";
            return json_decode(responeCheckQuery($query));

        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function getListVegetableByCatId($catId)
    {
        try {

            if ($catId <= 0) {
                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);
            }

            $query = "SELECT * FROM vegetable WHERE CategoryId = $catId;";
            echo responeCheckQuery($query);

        } catch (Exception $e) {

            $e->getMessage();

        }
    }

    public function getListVegetableByCatIds($catIds = [])
    {
        try {

            if ($catIds == []) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                return $array_respone;

            }

            $query = "SELECT * FROM vegetable WHERE CategoryID IN (";

            $key = true;

            foreach ($catIds as $catId) {   
                if ($key == true) {
                    $key = false;
                } else {
                    $query = $query . ',';
                }

                $query = $query . $catId;
            }

            $query = $query . ')';
            return json_decode(responeCheckQuery($query));
            
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function getVegetableById($vegetableID)
    {
        try {

            if ($vegetableID <= 0) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                return json_encode($array_respone);
                
            }

            $query = "SELECT * FROM vegetable WHERE vegetableID = $vegetableID";

            echo responeCheckQuery($query);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
