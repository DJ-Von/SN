<?php
require "db.php";
?>

<?php
	if (isset($_SESSION['logged_user'])) {
		# code...
?>
Autorized
<br>
Hello, <?php echo $_SESSION['logged_user']->fname.' '. $_SESSION['logged_user']->surname.'.';?>
<br>
<hr>
<a href="logout.php">Log out</a>
<?php
	}

	else{
?>

<form action='login.php' method="POST">
	
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
}
?>