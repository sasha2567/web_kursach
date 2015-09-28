<!DOCTYPE html>
<html>
<head>
	<title>Главная страница администратора</title>
</head>
<body>
Здесь размещены все разделы администрирования сайта
<br />
<?php echo anchor('adminadd', 'Click Here');?>
<br />
<br />
Список рецептов:
<br />
<ul>
<?php foreach ($recipes as $item):?>
        <li><?=$item['description']?>:<?=$item['ingridients']?>:<?=$item['recipe']?></li>
<?php endforeach; ?>
</ul>
</body>
</html>