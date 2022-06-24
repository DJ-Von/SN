<?php
require "db.php";

$data = $_POST;

if (isset($data['do_login'])) {
	$errors = array();
	$user = R::findOne('users', 'email = ?', array($data['email']));

	if($user){
		if(password_verify($data['password'], $user->password)){
			$_SESSION['logged_user'] = $user;
			header('Location: index.php', "charset=utf-8");
		}

		else{
			$errors[] = "Wrong password!";
		}
	}

	else{
		$errors[] = "There is no user with this email address!";
	}

	
}?>