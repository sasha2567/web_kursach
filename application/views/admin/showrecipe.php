<!DOCTYPE html>
<html>
<head>
	<title>Главная страница администратора</title>
</head>
<body>
Панель администрирования сайта http://justcooking.16mb.com
<?php
require_once 'menu.php';
?>
<br />
Список рецептов:
<br />
<ul>
<?php foreach ($recipes as $item):?>
        <li><?php echo anchor('adminredact/show/'.$item['recipe_id'], '\''.$item['description'].':'.$item['ingredients'].':'.$item['recipe'].'\'');?></li>
<?php endforeach; ?>
</ul>
</body>
</html>