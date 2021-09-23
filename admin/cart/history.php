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
    include '../class/order.php';
    session_start();
    $order = new order(1, "", 0, "");
    $order = $order->getAllOrderByCustomerId($_SESSION['info_customer']['customerId']);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-3">
                <?php include '../menu.php'; ?>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $t = 0;
                foreach ($order->data as $order) {
                    $t++ ?>
                    <tr class="table-primary">
                        <td><?php echo $t ?></td>
                        <th scope="row"><?php echo $order->Date ?></th>
                        <td><?php echo $order->Total ?></td>
                        <td><button class="btn-detail" id="<?php echo $order->OrderID ?>">detail</button></td>
                    </tr>
                <?php  } ?>

            </tbody>
        </table>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(".btn-detail").click(function() {
        var orderId = $(this).attr('id');
        $.ajax({
            url: "http://localhost/market/class/order.php",
            type: "post",
            data: {
                orderId: orderId,
            },
            dataType: "json",
            success: function(result) {

                if (result['success'] == true) {
                    alert(result['data'][0]['OrderID']);
                    window.location = "http://localhost/market/cart/detail.php?orderId=" + result['data'][0]['OrderID'];
                } else {
                    alert(result['message']);
                }
            },
        });
    });
</script>

</html>