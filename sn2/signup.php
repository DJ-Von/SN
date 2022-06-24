<?php
require "db.php";

$data = $_POST;
if (isset($data['do_signup'])) {
	# code...
	$errors = array();
	if (trim($data['fname']) == '') {
		# code...
		$errors[] = 'Enter your name!';
	}

	if (trim($data['surname']) == '') {
		# code...
		$errors[] = 'Enter your surname!';
	}

	if (trim($data['email']) == '') {
		# code...
		$errors[] = 'Enter your email!';
	}

	if (trim($data['password']) == '') {
		# code...
		$errors[] = 'Enter your password!';
	}

	if (trim($data['password_2']) != $data['password']) {
		# code...
		$errors[] = 'Passwords do not match!';
	}

	if (R::count('users', "email = ?", array($data['email'])) > 0) {
		# code...
		$errors[] = 'A user with this email already exists!';
	}


	if (empty($errors)) {
		# code...
		$user = R::dispense('users');
		$user->fname = $data['fname'];
		$user->surname = $data['surname'];
		$user->email = $data['email'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
		R::store($user);
		echo '<div style = "color: green">You are signed up!</div> <hr/>';
		header('Location: login.php');
	}

	else{
		echo '<div style = "color: red">'.array_shift($errors).'</div> <hr/>';
	}
}

?>

<form action="signup.php" method = "POST">
	
	<p>
		<p>Your name:</p>
		<input type="text" name="fname" value="<?php echo @$data['fname'] ?>">
	</p>

	<p>
		<p>Your surname:</p>
		<input type="text" name="surname" value="<?php echo @$data['surname'] ?>">
	</p>

	<p>
		<p>Your email:</p>
		<input type="email" name="email" value="<?php echo @$data['email'] ?>">
	</p>

	<p>
		<p>Your password:</p>
		<input type="password" name="password" value="<?php echo @$data['password'] ?>">
	</p>

	<p>
		<p>Your password again:</p>
		<input type="password" name="password_2" value="<?php echo @$data['password_2'] ?>">
	</p>

	<p>
		<button type="submit" name="do_signup">Sign up</button>
	</p>
</form>