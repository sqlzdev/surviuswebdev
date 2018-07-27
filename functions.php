<?php

	function isNull($User, $Password, $Password2, $Email){
		if(strlen(trim($User)) < 1 || strlen(trim($Password)) < 1 || strlen(trim($Password2)) < 1 || strlen(trim($Email)) < 1)
		{
			return true;
			} else {
			return false;
		}
	}

	function isEmail($Email)
	{
		if (filter_var($Email, FILTER_VALIDATE_EMAIL)){
			return true;
			} else {
			return false;
		}
	}

	function validatePassword($var1, $var2)
	{
		if (strcmp($var1, $var2) !== 0){
			return false;
			} else {
			return true;
		}
	}

	function minMax($min, $max, $valor){
		if(strlen(trim($valor)) < $min)
		{
			return true;
		}
		else if(strlen(trim($valor)) > $max)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function userExist($User, $mysqli)
    {

		$stmt = $mysqli->prepare("SELECT id FROM users WHERE User = ? LIMIT 1");
		$stmt->bind_param("s", $User);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();

		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}

	function emailExist($Email, $mysqli)
    {

		$stmt = $mysqli->prepare("SELECT id FROM users WHERE Email = ? LIMIT 1");
		$stmt->bind_param("s", $Email);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();

		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}

	function hashPassword($Password)
	{
		$hash = password_hash($Password, PASSWORD_DEFAULT);
		return $hash;
	}

	function resultBlock($errors){
		if(count($errors) > 0)
		{
			echo "<div class='mensaje'>";
			foreach($errors as $error)
			{
				echo "<li style='list-style:none'>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}

	function registerUser($User, $pass_hash, $Email, $active, $user_type){

		global $mysqli;

		$stmt = $mysqli->prepare("INSERT INTO users (User, Password, Email, active, id_type) VALUES(?,?,?,?,?)");
		$stmt->bind_param('ssssi', $User, $pass_hash, $Email, $active, $user_type);

		if ($stmt->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;
		}
	}

	function isNullLogin($User, $Password){
		if(strlen(trim($User)) < 1 || strlen(trim($Password)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function login($User, $Password)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT id, id_type, Password FROM users WHERE User = ? || Email = ? LIMIT 1");
		$stmt->bind_param("ss", $User, $User);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;

		if($rows > 0) {

			if(isActive($User)){

				$stmt->bind_result($id, $id_type, $Password);
				$stmt->fetch();

				$validatePassword = password_verify($Password, $Password);

				if($validatePassword){

					lastSession($id);
					$_SESSION['id_User'] = $id;
					$_SESSION['user_type'] = $id_type;

					header("location: cpanel.php");
					} else {

					$errors = "Error pw";
				}
			}
			} else {
			$errors = "El nombre de usuario o correo electr&oacute;nico no existe";
		}
		return $errors;
	}

	function lastSession($id)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("UPDATE users SET last_session=NOW(), token_password='', password_request=1 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->close();
	}

	function isActive($User)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT active FROM users WHERE User = ? || Email = ? LIMIT 1");
		$stmt->bind_param('ss', $User, $User);
		$stmt->execute();
		$stmt->bind_result($active);
		$stmt->fetch();

		if ($active == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function generateTokenPass($user_id)
	{
		global $mysqli;

		$token = generateToken();

		$stmt = $mysqli->prepare("UPDATE users SET token_password=?, password_request=1 WHERE id = ?");
		$stmt->bind_param('ss', $token, $user_id);
		$stmt->execute();
		$stmt->close();

		return $token;
	}

	function getValor($field, $fieldWhere, $value)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT $field FROM users WHERE $fieldWhere = ? LIMIT 1");
		$stmt->bind_param('s', $value);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;

		if ($num > 0)
		{
			$stmt->bind_result($_field);
			$stmt->fetch();
			return $_field;
		}
		else
		{
			return null;
		}
	}

	function getPasswordRequest($id)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT password_request FROM users WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($_id);
		$stmt->fetch();

		if ($_id == 1)
		{
			return true;
		}
		else
		{
			return null;
		}
	}

	function verificationTokenPass($user_id, $token){

		global $mysqli;

		$stmt = $mysqli->prepare("SELECT active FROM users WHERE id = ? AND token_password = ? AND password_request = 1 LIMIT 1");
		$stmt->bind_param('is', $user_id, $token);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;

		if ($num > 0)
		{
			$stmt->bind_result($active);
			$stmt->fetch();
			if($activacion == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function changePassword($Password, $user_id, $token){

		global $mysqli;

		$stmt = $mysqli->prepare("UPDATE users SET Password = ?, token_password='', password_request=0 WHERE id = ? AND token_password = ?");
		$stmt->bind_param('sis', $Password, $user_id, $token);

		if($stmt->execute()){
			return true;
			} else {
			return false;
		}
	}
