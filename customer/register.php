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
                    <label for="usr">UserName: </label>
                    <input required="true" type="text" class="form-control fullname" name="userName" id="userName" value="">
                    <p class="username"></p>
                </div>
                <div class="form-group">
                    <label for="usr">Fullname: </label>
                    <input required="true" type="text" class="form-control fullname" name="fullname" id="fullname" value="">
                    <p class="fullname"></p>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input required="true" type="password" class="form-control password" name="password" id="password" value="">
                    <p class="password"></p>

                </div>
                <div class="form-group">
                    <label for="pwd">address:</label>
                    <input required="true" type="text" class="form-control address" name="address" id="address" value="">
                    <p class="address"></p>
                </div>
                <div class="form-group">
                    <label for="pwd">phone - number:</label>
                    <input required="true" type="text" class="form-control phone_number" name="phone_number" id="phone_number" value="">
                    <p class="phone"></p>
                </div>
                <div class="form-group">
                    <label for="pwd">birthday:</label>
                    <input required="true" type="text" class="form-control birthday" name="birthday" id="birthday" value="">
                    <p class="birthday"></p>
                </div>
                <button type="submit" class="btn btn-success" name="btn-success">register</button>
            </form>

        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(".btn-success").click(function() {
        var userName = $("#userName").val();
        var fullname = $("#fullname").val();
        var password = $("#password").val();
        var address = $("#address").val();
        var birthday = $("#birthday").val();
        var phone_number = $("#phone_number").val();

        $.ajax({
            url: "http://localhost:81/market/customer/saveRegister.php",
            type: "post",
            data: {
                userName: userName,
                fullname: fullname,
                password: password,
                address: address,
                birthday: birthday,
                phone_number: phone_number,
            },
            dataType: "json",
            success: function(result) {
                if (result['success'] == true) {
                    window.location = "http://localhost:81/market/vegetable/index.php";
                }
                else {
                    alert(result['message']['userName']);
                    alert(result['message']['password']);
                    // $(".username").html(result['message']['userName']);
                    // $(".fullname").html(result['message']['fullname']);
                    // $(".password").html(result['message']['password']);
                    // $(".address").html(result['message']['address']);
                    // $(".phone").html(result['message']['phone_number']);
                    // $(".birthday").html(result['message']['birthday']);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus, errorThrown);
            }
        });
    });
</script>
</html>