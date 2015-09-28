<!DOCTYPE html>
<html>
<head>
	<title>Страница добавления рецептов</title>
</head>
<body>
<?php
$attributes = array(
    'class' => 'recipe_add', 
    'id' => 'form_add_recipe'
);
echo form_open('adminadd/add', $attributes); 
?>
<label>Название</label>
<input type="text" name="recipe_description" />
<br />
<label>Ингридиенты</label>
<input type="text" name="recipe_ingridients" />
<br />
<label>Рецепт</label>
<textarea rows="10" cols="80" name="recipe_recipe"></textarea>
<br />
<input type="submit" name="recipe_descriptin" value="Отправить рецепт" />
<?php form_close();?>
</body>
</html>