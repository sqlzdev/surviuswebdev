<?php
require 'php/connection.php';
	include 'php/functions.php';

	$errors = array();

	if(!empty($_POST))
	{
		$User = $mysqli->real_escape_string($_POST['User']);
		$Password = $mysqli->real_escape_string($_POST['Password']);
		$Password2 = $mysqli->real_escape_string($_POST['Password2']);
		$Email = $mysqli->real_escape_string($_POST['Email']);
		$captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);
		$active = 1;
		$user_type = 2;
		$secret = '6LdmbGYUAAAAALKNyVyN1qNtTZGWHSPv0VRdzNdR';

		if(!$captcha){
			$errors[] = "Check the captcha";
		}

		if(isNull($User, $Password, $Password2, $Email))
		{
			$errors[] = "Fill all the fields";
		}

		if(!isEmail($Email))
		{
			$errors[] = "Invalid email adress";
		}

		if(!validatePassword($Password, $Password2))
		{
			$errors[] = "Password do not match";
		}

		if(userExist($User, $mysqli))
		{
			$errors[] = "$User already exist";
		}

		if(emailExist($Email, $mysqli))
		{
			$errors[] = "$Email already exist";
		}

		if(count($errors) == 0)
		{

			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

			$arr = json_decode($response, TRUE);

			if($arr['success'])
			{

				$password_hash = hashPassword($Password);

				$register = registerUser($User, $password_hash, $Email, $active, $user_type);
				if($register > 1)
				{
						echo "DONE";
						} else {
						$error[] = "Wrong Captcha";
					}

					} else {
					$errors[] = "Error to register";
				}
			}
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Register Survius</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


    <link rel="stylesheet" href="icon/style.css">
    <link rel="stylesheet" href="css/style.css">
<script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>

        <div class="header">
            <div class="logo-title">
                <img src="image/survius.png" alt="">
                <h2>Survius</h2>
            </div>
            <div class="menu">
            <a href="index.php"><li class="module-register">Sign-In</li></a>
          </div>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form">
            <div class="welcome-form"><h2>Create Account</h2></div>

            <div class="user line-input">
                <label for="User" class="lnr lnr-user"></label>
                <input type="text" class="field" placeholder="User" name="User" value="<?php if(isset($User)) echo $User; ?>"  required>
            </div>
            <div class="user line-input">
                <label for="Password "class="lnr lnr-lock"></label>
                <input type="password" class="field" placeholder="Password" name="Password" required>
            </div>
            <div class="password line-input">
                <label for="Password2" class="lnr lnr-lock"></label>
                <input type="password" class="field" placeholder="Repeat password" name="Password2" required>
            </div>
            <div class="user line-input">
                <label for="Email" class="lnr lnr-envelope"></label>
                <input type="Email" class="field" placeholder="Email" name="Email" value="<?php if(isset($Email)) echo $Email; ?>" required>
            </div>
            <div style="display: flex;justify-content: center;margin-top: 40px;" class="g-recaptcha" data-sitekey="6LdmbGYUAAAAAN2GP8BIUM5JFvXJjuXAF6qIv7ao"></div>

			<?php echo resultBlock($errors); ?>

            <button type="submit">Check In<label class="lnr lnr-chevron-right"></label></button>

    </form>


    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>

</body>
</html>
