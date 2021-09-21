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

    <div class="container">
    <div class="row">
                    <div class="col-md-12 p-3">
                        <?php include '../menu.php'; ?>
                    </div>
                </div>
        <div class="col-md-12">
            <h1>register</h1>
        </div>
        <div class="panel-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="usr">Fullname: </label>
                    <input required="true" type="text" class="form-control fullname" name="fullname" id="fullname" value="">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input required="true" type="password" class="form-control password" name="password" id="password" value="">
                </div>
                <div class="form-group">
                    <label for="pwd">address:</label>
                    <input required="true" type="text" class="form-control address" name="address" id="address" value="">
                </div>
                <div class="form-group">
                    <label for="pwd">city:</label>
                    <input required="true" type="text" class="form-control city" name="city" id="city" value="">
                </div>
                <button class="btn btn-success" name="btn-success">register</button>
            </form>

        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(".btn-success").click(function() {
        var fullname = $("#fullname").val();
        var password = $("#password").val();
        var address = $("#address").val();
        var city = $("#city").val();
        $.ajax({
            url: "https://localhost/market/customer/saveRegister.php",
            type: "post",
            data: {
                fullname: fullname,
                password: password,
                address: address,
                city: city,
            },
            dataType: "json",
            success: function(result) {
                if (result['success'] == true) {
                    window.location = "http://localhost/market/vegetable/index.php";
                }
                else {
                    alert('error when register account');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus, errorThrown);
            }
        });
    });
</script>
</html>