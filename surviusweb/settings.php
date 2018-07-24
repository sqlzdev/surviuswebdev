<?php session_start();

    if(isset($_SESSION['User'])){
        require 'frontend/settings.php';
    }else{
        header ('location: login.php');
    }

?>
