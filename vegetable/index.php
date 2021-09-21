<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/css/common.css">
    <link rel="stylesheet" href="../css/css/style.css">
    <script src="../css/bootstrap/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    require_once '../class/vegetable.php';
    include '../class/category.php';
    $category = new category('', '');
    $category = $category->getAllCategory();
    $vegetable = new vegetable('', '', 0, '', 0, 0);
    if (isset($_POST['submit1'])) {

        $vegetable = $vegetable->getListVegetableByCatIds($_POST['vegetable']);
    } else {

        $vegetable = $vegetable->getAllVegetable();
    }

    ?>
        <div class="container">

            <div class="col-md-12 p-3">
                <?php include '../menu.php'; ?>
            </div>
        <div class="row">
            <div class="col-md-2">
                <form action="" method="post">

                    <?php
                    foreach ($category->data as $category) {
                    ?>
                        <input type="checkbox" id="vehicle1" name="vegetable[]" value="<?php echo $category->CategoryID ?>">
                        <label for="vehicle1"> <?php echo $category->Name ?></label><br>
                    <?php } ?>
                    <input type="submit" name="submit1" value="Submit">
                </form>
            </div>
            <div class="col-md-10">
                <div class="row">

                    <?php
                    $t = 0;
                    foreach ($vegetable->data as $vegetable) {
                        $t++
                    ?>
                        <div class="col-md-4 ">
                            <!-- bbb_deals -->
                            <div class="bbb_deals">
                                <div class="ribbon ribbon-top-right"><span><small class="cross">x </small>4</span></div>
                                <div class="bbb_deals_title">Today's Combo Offer</div>
                                <div class="bbb_deals_slider_container">
                                    <div class=" bbb_deals_item">
                                        <div class="bbb_deals_image"><img id="<?php echo "image" . $vegetable->VegetableID ?>" class="product" src="<?php echo "http://localhost/market/css/images/" . $vegetable->Image ?>" alt=""></div>
                                        <div class="bbb_deals_content">
                                            <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                                                <div class="bbb_deals_item_price_a ml-auto"><strike>$<?php echo $vegetable->Price * 110 / 100 ?></strike></div>
                                            </div>
                                            <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                                                <div class="bbb_deals_item_name" id="<?php echo "name" . $vegetable->VegetableID ?>"><?php echo $vegetable->VegetableName ?></div>
                                                <div class="bbb_deals_item_price ml-auto" id="<?php echo "price" . $vegetable->VegetableID ?>">$<?php echo $vegetable->Price ?></div>
                                            </div>
                                            <div class="available">
                                                <div class="available_line d-flex flex-row justify-content-start">
                                                    <div class="available_title">Available: <span id="<?php echo "amount" . $vegetable->VegetableID ?>"><?php echo $vegetable->Amount ?></span></div>
                                                    <div class="sold_stars ml-auto"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                                    <button name="order" class="order" id="<?php echo $vegetable->VegetableID ?>"><?php if (isset($_SESSION['info_customer']['fullname'])) {
                                                                                                                                        echo "buy";
                                                                                                                                    } else {
                                                                                                                                        echo "";
                                                                                                                                    }  ?></button>
                                                </div>
                                                <div class="available_bar"><span style="width:17%"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".order").click(function() {
            var id = $(this).attr('id');
            // co cua san pham 
            var name = $("#name" + id).text();
            var picture = $("#image" + id).attr('src');
            var amount = $("#amount" + id).text();
            var price = parseInt($("#price" + id).text().replace(/[^0-9.]/g, ""));
            $.ajax({
                url: "http://localhost/market/cart/cartbusiness.php",
                type: "post",
                data: {
                    id: id,
                    name: name,
                    picture: picture,
                    amount: amount,
                    price: price
                },
                dataType: "json",
                success: function(result) {
                    if (result['success'] == true) {
                        alert(result['message']);

                    } else {
                        alert(result['message']);
                    }
                },
            });
        });
    });
</script>

</html>