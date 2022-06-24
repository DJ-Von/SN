<?php
require "login.php";
?>

<?php
	if (isset($_SESSION['logged_user'])) {
?>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="style.css">
Autorized
<br>
<meta charset="utf-8">
Hello, <?php echo $_SESSION['logged_user']->fname.' '. $_SESSION['logged_user']->surname.'.';?>
<br>

<img class="avatar" src=<?php echo 'img/avatars/'.$_SESSION['logged_user']->avatar?>>


<hr>
<a href="messages.php">Messages</a>
<br>
<a href="logout.php">Log out</a>
<br>
<a href="deleteaccount.php">Delete account</a>
<?php
}

else{
	if (!empty($errors)) {
		echo '<div style = "color: red">'.array_shift($errors).'</div> <hr/>';
	}
?>

<form action='index.php' method="POST">
	<meta charset="utf-8">
	<p>
		<p>Your email:</p>
		<input type="text" name="email" value="<?php echo @$data['email'] ?>">
	</p>

	<p>
		<p>Your password:</p>
		<input type="password" name="password" value="<?php echo @$data['password'] ?>">
	</p>

	<p>
		<button type="submit" name="do_login">Log in</button>
	</p>
</form>
<br>
<a href="signup.php">Регистрация</a>

<?php
}?>