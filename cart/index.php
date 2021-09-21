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
        $product = $_SESSION['cart']['product'];
        $totalPrice = $_SESSION['cart']['totalPrice'];
    ?>

    <div class="container mt-5 p-3 rounded cart">
        <div class="row">
            <div class="col-md-12 p-3">
                <?php include '../menu.php'; ?>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="product-details mr-2">
                    <div class="d-flex flex-row align-items-center"><i class="fa fa-long-arrow-left"></i><span class="ml-2">Continue Shopping</span></div>
                    <hr>
                    <h6 class="mb-0">Shopping cart</h6>
                    <div class="d-flex justify-content-between"><span>You have <?php if (isset($product)) echo count($product) ?> items in your cart</span>
                        <div class="d-flex flex-row align-items-center"><span class="text-black-50">Sort by:</span>
                            <div class="price ml-2"><span class="mr-1">price</span><i class="fa fa-angle-down"></i></div>
                        </div>
                    </div>
                    <?php if (isset($product))
                        foreach ($product as $product) { ?>
                        <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                            <div class="d-flex flex-row"><img class="rounded" src="<?php echo $product['picture'] ?>" id="<?php echo "picture" . $product['id'] ?>" width="40">
                                <div class="ml-2"><span class="font-weight-bold d-block"><?php echo $product['name'] ?></span><span class="spec"></span></div>
                            </div>
                            <div class="d-flex flex-row align-items-center"><span class="d-block" id="<?php echo "amount" . $product['id'] ?>"><?php echo $product['amount'] ?></span><span class="d-block ml-5 font-weight-bold" id="<?php echo "price" . $product['id'] ?>"><?php echo $product['price'] ?></span><i class="fa fa-trash-o ml-3 text-black-50"></i></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="payment-info">
                    <div><label class="credit-card-label">Name on card</label><input type="text" class="form-control credit-inputs" placeholder="<?php if (isset($_SESSION['info_customer']["fullname"])) echo $_SESSION['info_customer']["fullname"] ?>"></div>
                    <div class="row">
                        <div class="col-md-12"><label class="credit-card-label">Date</label><input type="text" class="form-control credit-inputs" placeholder="<?php echo (date("Y-m-d")); ?>"></div>
                        <div class="col-md-12"><label class="credit-card-label">Note</label><textarea type="text" class="form-control credit-inputs" id="note" placeholder="note..."></textarea></div>
                    </div>
                    <hr class="line">
                    <div class="d-flex justify-content-between information"><span>Subtotal</span><span>$<?php if (isset($totalPrice)) echo $totalPrice ?></span></div>
                    <div class="d-flex justify-content-between information"><span>Shipping</span><span><?php if (isset($totalPrice)) echo $totalPrice * 10 / 100 ?></span></div>
                    <div class="d-flex justify-content-between information"><span>Total(Incl. taxes)</span><span><?php if (isset($totalPrice)) echo $totalPrice + $totalPrice * 10 / 100 ?></span></div>
                    <button class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="button"><span>$<?php if (isset($totalPrice)) echo $totalPrice + $totalPrice * 10 / 100 ?></span><span>Checkout<i class="fa fa-long-arrow-right ml-1"></i></span></button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".btn-block").click(function() {
            var note = $("#note").val();

            $.ajax({
                url: "http://localhost/market/cart/saveorder.php",
                type: "post",
                data: {
                    note: note
                },
                dataType: "json",
                success: function(result) {
                    if (result['success'] == true) {
                        window.location = "http://localhost/market/vegetable/index.php";

                    } else {
                        alert(result['message']);
                    }
                },
            });
        });
    });
</script>

</html>