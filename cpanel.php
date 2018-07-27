<?php
	session_start();
	require 'php/connection.php';
	include 'php/functions.php';
	
	if(!isset($_SESSION["id_User"])){ 
		header("Location: index.php");
	}
	
	$iduser = $_SESSION['id_User'];
	
	$sql = "SELECT id, User FROM users WHERE id = '$iduser'";
	$result = $mysqli->query($sql);
	
	$row = $result->fetch_assoc();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Survius Control Panel</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


    <link rel="stylesheet" href="icon/style.css">
    <link rel="stylesheet" href="css/cpstyle.css">


            <div class="header">
                <div class="logo-title">
                    <img src="image/survius.png" alt="">
                    <h2>Survius</h2>
                </div>
            </div>
            <ul>
      <li><a class="active" href="main.php">Home</a></li>
      <li><a href="clan.php">Clan Managment</a></li>
      <li><a href="settings.php">User settings</a></li>
      <li style="float:right"><a class="active2" href="logout.php">Logout</a></li>
    </ul>

</head>
<body>
  <div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    This site is in development yet, report every error.
  </div>
</body>
</html>