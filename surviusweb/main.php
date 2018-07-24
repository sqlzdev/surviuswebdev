<?php session_start();

    if(isset($_SESSION['User'])){
        require 'frontend/cp.php';
    }else{
        header ('location: login.php');
    }

?>
