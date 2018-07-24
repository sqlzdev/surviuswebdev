<?php session_start();

    if(isset($_SESSION['User'])) {
        header('location: main.php');
    }else{
        header('location: login.php');
    }


?>
