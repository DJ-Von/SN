<?php
require "db.php";
require "random_phrases.php";

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

	$check = can_upload($_FILES['avatar']);
    
    if($check === true){
        // загружаем изображение на сервер
        $getMime = explode('.', $_FILES['avatar']['name']);
		$mime = strtolower(end($getMime));
		$name = random_number().'.'.$mime;
		copy($_FILES['avatar']['tmp_name'], 'img/avatars/'.$name);
     	//echo "<strong>Файл успешно загружен!</strong>";
     }
     else{
        // выводим сообщение об ошибке
     	$errors[] = $check;  
     }

	if (empty($errors)) {
		# code...
		$user = R::dispense('users');
		$user->fname = $data['fname'];
		$user->surname = $data['surname'];
		$user->email = $data['email'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
		$user->avatar = $name;
		R::store($user);
		header('Location: /index.php', "charset=utf-8");
	}

	else{
		echo '<div style = "color: red">'.array_shift($errors).'</div> <hr/>';
	}
}?>
<meta charset="utf-8">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<form action="signup.php" method = "POST" enctype="multipart/form-data">
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
		<p>Your avatar: </p>
		<input type="file" name="avatar">
	</p>

	<p>
		<button type="submit" name="do_signup">Sign up</button>
	</p>
</form>