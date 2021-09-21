            <div class="row d-flex justify-content-around">
                <div class="col-md-2">Market online</div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-around">
                            <div class="col-md-3"><a href="http://localhost/market/vegetable/index.php">Vegetable</a></div>
                            <div class="col-md-3"><a href="http://localhost/market/cart/index.php">Cart</a></div>
                            <div class="col-md-3"><a href="http://localhost/market/cart/history.php"><?php if (isset($_SESSION['info_customer']['fullname'])){echo "History";} else {echo "";}  ?></a> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="row d-flex">
                        <div class="col-md-6"><a href="http://localhost/market/customer/logout.php"><?php if (isset($_SESSION['info_customer']['fullname'])){echo "logout";} else {echo "login";}  ?></a></div>
                        <div class="col-md-6"><?php if (isset($_SESSION['info_customer']['fullname'])) echo $_SESSION['info_customer']['fullname'] ?></div>
                    </div>
                </div>
            </div>