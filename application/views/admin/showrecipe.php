<!DOCTYPE html>
<html>
<head>
	<title>Панель администрирования сайта http://justcooking.16mb.com|Главная страница администратора</title>
</head>
<body>

<?php
require_once 'menu.php';
?>
<br />
Список рецептов:
<br />
<ul>
<?php foreach ($recipes as $item):?>
        <li>

        <a href="/adminredact/show/<?=$item['recipe_id']?>">
        	<img src="/../img/upload/<?=$item['image']?>" />
        </a>
        &nbsp;
        <a href="/adminredact/show/<?=$item['recipe_id']?>">
        	<?=$item['description']?>
        </a>
        </li>
<?php endforeach; ?>
</ul>
</body>
</html>