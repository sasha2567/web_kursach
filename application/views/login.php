<!DOCTYPE html>
<html>
<head>
	<title>Страница добавления рецептов</title>
</head>
<body>
<?php
$attributes = array(
    'class' => 'user_login', 
    'id' => 'form_user_login'
);
echo form_open('login/logined', $attributes); 
?>
<label>Имя пользователя</label>
<input type="text" name="username" />
<br />
<label>Пароль</label>
<input type="text" name="user_password" />
<br />
<input type="submit" name="user_login_btn" value="Войти" />
<?php form_close();?>
</body>
</html>