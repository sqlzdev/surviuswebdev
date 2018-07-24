<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Register Survius</title>

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
            <a href="login.php"><li class="module-register">Sign-In</li></a>
          </div>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form">
            <div class="welcome-form"><h2>Create Account</h2></div>

            <div class="user line-input">
                <label class="lnr lnr-envelope"></label>
                <input type="text" class="field" placeholder="Email" name="Email">
            </div>
            <div class="user line-input">
                <label class="lnr lnr-user"></label>
                <input type="text" class="field" placeholder="Username" name="User">
            </div>
            <div class="password line-input">
                <label class="lnr lnr-lock"></label>
                <input type="password" class="field" placeholder="Password" name="Password">
            </div>
            <div class="password line-input">
                <label class="lnr lnr-lock"></label>
                <input type="password" class="field" placeholder="Confirm Password" name="Password2">
            </div>

            <?php if(!empty($error)): ?>
            <div class="mensaje">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>

            <button type="submit">Check In<label class="lnr lnr-chevron-right"></label></button>

    </form>
    </div>


    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
