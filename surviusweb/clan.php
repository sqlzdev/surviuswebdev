<?php session_start();

    if(isset($_SESSION['User'])){
        require 'frontend/clansettings.php';
    }else{
        header ('location: login.php');
    }

?>
