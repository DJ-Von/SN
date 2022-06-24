<?php
require "db.php";
$filePath = 'img/avatars/'.$_SESSION['logged_user']->avatar;
if (file_exists($filePath)) {
    unlink($filePath);
}

R::trash($_SESSION['logged_user']);
unset($_SESSION['logged_user']);
?>
<meta charset="utf-8">

<p>Ваш аккаунт удалён.</p>
<a href="index.php">На главную</a>