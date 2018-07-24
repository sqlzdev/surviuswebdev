<?php

    try{
         $connection = new PDO('mysql:host=localhost;dbname=accounts', 'root', '');
    }catch(PDOException $prueba_error){
        echo "Error: " . $prueba_error->getMessage();
    }


?>
