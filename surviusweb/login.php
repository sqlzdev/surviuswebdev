<?php session_start();

    if(isset($_SESSION['User'])) {
        header('location: index.php');
    }

    $error = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $User = $_POST['User'];
        $Password = $_POST['Password'];
        $Password = hash('sha512', $Password);

        try{
            $connection = new PDO('mysql:host=localhost;dbname=accounts', 'root', '');
            }catch(PDOException $error){
                echo "Error: " . $error->getMessage();
            }

        $statement = $connection->prepare('SELECT * FROM login WHERE User = :User AND Password = :Password');

        $statement->execute(array(
            ':User' => $User,
            ':Password' => $Password
        ));

        $result = $statement->fetch();

        if ($result !== false){
            $_SESSION['User'] = $User;
            header('location: main.php');
        }else{
            $error .= '<i>This Username doesnt exist</i>';
        }
    }

require 'frontend/login.php';


?>
