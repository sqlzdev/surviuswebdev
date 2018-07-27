<?php
	require 'php/connection.php';
	include 'php/functions.php';

	session_start();

	if(isset($_SESSION["User"])){
		header("Location: cpanel.php");
	}

	$errors = array();

	if(!empty($_POST))
	{
		$User = $mysqli->real_escape_string($_POST['User']);
		$Password = $mysqli->real_escape_string($_POST['Password']);

		if(isNullLogin($User, $Password))
		{
			$errors[] = "error";
		}

		$errors[] = login($User, $Password);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Survius Control Panel</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


    <link rel="stylesheet" href="icon/style.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

        <div class="header">
            <div class="logo-title">
                <img src="image/survius.png" alt="">
                <h2>Survius</h2>
            </div>
            <div class="menu">
            <a href="register.php"><li class="module-register">Register</li></a>
          </div>
        </div>

        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="form">
            <div class="welcome-form"><h2>Survius Control Panel</h2></div>
            <div class="user line-input">
                <label class="lnr lnr-user"></label>
                <input type="text" class="field" placeholder="Username" name="User" required>
            </div>
            <div class="password line-input">
                <label class="lnr lnr-lock"></label>
                <input type="password" class="field" placeholder="Password" name="Password" required>
            </div>

						<?php echo resultBlock($errors); ?>

            <button type="submit">Login<label class="lnr lnr-chevron-right"></label></button>
        </form>

    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
