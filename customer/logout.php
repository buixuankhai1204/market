<?php
session_start();
session_destroy();

logout();


    function logout(){
        header('Location: http://localhost/market/customer/login.php');
    }

?>