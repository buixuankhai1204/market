<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css/common.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <script src="../css/bootstrap/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

<body>
<?php
    session_start();
    include '../class/category.php';
    $category = new category('', '');
    $category = $category->getAllCategory();

?>
    <div class="container">
    <div class="row">
                    <div class="col-md-12 p-3">
                        <?php include '../menu.php'; ?>
                    </div>
                </div>

        <section class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Add product</h3>
            </div>
            <div class="panel-body">

                <form action="http://localhost/market/class/vegetable.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="POST">

                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="vegetableName" id="VegetableName" placeholder="VegetableName" required>
                        </div>
                    </div> <!-- form-group // -->
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Unit</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="unit" id="unit" placeholder="unit" required>
                        </div>
                    </div> <!-- form-group // -->
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Amout</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="amout" id="Amout" placeholder="Amout" required>
                        </div>
                    </div> <!-- form-group // -->
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Category Name</label>
                        <select id="cars" class="col-sm-6 form-control" name="categoryId" required>
                            <?php foreach($category->data as $category) { ?>
                            <option value="<?php echo $category->CategoryID ?>"><?php echo $category->Name?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- form-group // -->
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">price</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="price" id="price" placeholder="price" required>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label class="control-label small" for="file_img">image:</label> <input type="file" name="file_img" required>
                            </div>
                        </div> <!-- form-group // -->
                        <hr>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
                            </div>
                        </div> <!-- form-group // -->
                </form>

            </div><!-- panel-body // -->
        </section><!-- panel// -->


    </div> <!-- container// -->
</body>

</html>