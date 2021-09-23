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

    include '../class/category.php';
    $category = new category('','');

    if(isset($_POST['submit'])){

        $category = $category->addCcategory(new category($_POST['name'],$_POST['password']));

    } else {
        $category = $category->getAllCategory();
    }
    
    ?>
    <div class="container">
    <div class="row">
                    <div class="col-md-12 p-3">
                        <?php include '../menu.php'; ?>
                    </div>
                </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                <form action="" method="post">
                <div class="form-group">
                    <label for="usr">Name: </label>
                    <input required="true" type="text" class="form-control" name="name" id="usr" value="" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Description:</label>
                    <input required="true" type="password" class="form-control" name="password" id="pwd" value="" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Login</button>
            </form>
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Decription</th>
                                <th scope="col">created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $t = 0;
                            if ($category->success == true )

                            foreach ($category->data as $category) :
                                $t++ 
                                ?>
                                <tr class="table-primary">
                                    <td><?php echo $t ?></td>
                                    <th scope="row"><?php echo $category->Name ?></th>
                                    <td><?php echo $category->Description ?></td>
                                    <td><?php echo $category->created_at ?></td>
                                </tr>
                            <?php  endforeach  ?>

                        </tbody>
                    </table>
                </div> .
            </div>
        </div>

    </div>
</body>

</html>