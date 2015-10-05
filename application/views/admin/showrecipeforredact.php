<!DOCTYPE html>
<html>
<head>
	<title>Страница редактирования рецептов</title>
</head>
<body>
Панель администрирования сайта http://justcooking.16mb.com
<?php
require_once 'menu.php';
?>
Все 
<?php
$attributes = array(
    'class' => 'recipe_redact', 
    'id' => 'form_redact_recipe'
);
echo form_open('adminredact/redact/'.$recipe_id, $attributes); 
?>
<label>Название</label>
<input type="text" name="recipe_description" value="<?=$description?>"/>
<br />
<label>Ингридиенты</label>
<input type="text" name="recipe_ingredients" value="<?=$ingredients?>"/>
<br />
<label>Рецепт</label>
<textarea rows="10" cols="80" name="recipe_recipe"><?=$recipe?></textarea>
<br />
<input type="submit" name="recipe_redact_btn" value="Сохранить изменения в рецепте" />
<?php form_close();?>
</body>
</html>