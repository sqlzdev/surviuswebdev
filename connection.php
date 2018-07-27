<?php

    require_once('config.php');
	
	$mysqli=new mysqli($server, $user, $password, $db); //Check value on config.php
	
	if(mysqli_connect_errno()){
		echo 'Failed Connection : ', mysqli_connect_error();
		exit();
	}
	
?>