<?php
require "db.php";

$data = $_POST;

if (isset($data['do_login'])) {
	# code...
	$errors = array();
	$user = R::findOne('users', 'email = ?', array($data['email']));

	if($user){
		if(password_verify($data['password'], $user->password)){
			$_SESSION['logged_user'] = $user;
			echo '<div style = "color: green">You are loged in!</div> <hr/>';
			header('Location: index.php');
		}

		else{
			$errors[] = "Wrong password!";
		}
	}

	else{
		$errors[] = "There is no user with this email address!";
	}

	if (!empty($errors)) {
		echo '<div style = "color: red">'.array_shift($errors).'</div> <hr/>';
	}
}

?>
