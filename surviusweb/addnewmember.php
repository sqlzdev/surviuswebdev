<?php
    include("connection.php");

    $new= $_POST['user'];

    $query=("INSERT INTO members(user) VALUES('$new')");
    $result= $connection->query($query);

    if ($result != true){
            header('location: clan.php');
    }
    else{
            header('location: clan.php');
    }
 ?>
