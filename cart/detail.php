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
    $order = $order->getOrderDetailByOrderId($_GET['orderId']);
    $order = json_decode($order);

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
                    <th scope="col">Name</th>
                    <th scope="col">picture</th>
                    <th scope="col">amount</th>
                    <th scope="col">price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $t = 0;
                foreach ($order->data as $order) {
                    $t++ ?>
                    <tr class="table-primary">
                        <td><?php echo $t ?></td>
                        <th scope="row"><?php echo $order->name ?></th>
                        <td><img src="<?php echo $order->picture ?>" alt=""></td>
                        <td><?php echo $order->Quantity ?></td>
                        <td><?php echo $order->Price * $order->Quantity ?></td>
                    </tr>
                <?php  } ?>

            </tbody>
        </table>
    </div>

</body>

</html>