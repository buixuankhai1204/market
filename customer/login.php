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
                        <?php include 'menu.php'; ?>
                    </div>
                </div>
        <div class="col-md-12">
            <h1>login</h1>
        </div>
        <div class="panel-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="usr">your's ID: </label>
                    <input required="true" type="text" class="form-control" name="userName" id="usr">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input required="true" type="password" class="form-control" name="password" id="pwd">
                </div>
                <button class="btn btn-success">Login</button>
            </form>

        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(".btn-success").click(function() {

        var userName = $("#usr").val();
        var password = $("#pwd").val();

        $.ajax({
            url: "http://localhost:81/market/customer/checkLogin.php",
            type: "post",
            data: {
                userName: userName,
                password: password,
            },
            dataType: "json",
            success: function(result) {
                if (result['success'] == true) {
                    window.location = "http://localhost:81/market/vegetable/index.php";
                }
                else {
                    alert(result['message']);
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus, errorThrown);
            }
        });
    });
    </script>

</html>