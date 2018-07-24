<?php session_start();

    if(isset($_SESSION['User'])) {
        header('location: index.php');
    }



    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $Email = $_POST['Email'];
        $User = $_POST['User'];
        $Password = $_POST['Password'];
        $Password2 = $_POST['Password2'];

        $Password = hash('sha512', $Password);
        $Password2 = hash('sha512', $Password2);

        $error = '';

        if (empty($Email) or empty($User) or empty($Password) or empty($Password2)){

            $error .= '<i>Fill the fields</i>';
        }else{
            try{
                $connection = new PDO('mysql:host=localhost;dbname=accounts', 'root', '');
            }catch(PDOException $error){
                echo "Error: " . $error->getMessage();
            }

            $statement = $connection->prepare('SELECT * FROM login WHERE User = :User LIMIT 1');
            $statement->execute(array(':User' => $User));
            $result = $statement->fetch();


            if ($result != false){
                $error .= '<i>This user already exists</i>';
            }

            if ($Password != $Password2){
                $error .= '<i>Passwords do not match</i>';
            }


        }

        if ($error == ''){
            $statement = $connection->prepare('INSERT INTO login (id, Email, User, Password) VALUES (null, :Email, :User, :Password)');
            $statement->execute(array(

                ':Email' => $Email,
                ':User' => $User,
                ':Password' => $Password

            ));

            $error .= '<i style="color: green;">Your user has been registered correctly</i>';
        }
    }


    require 'frontend/register.php';

?>
