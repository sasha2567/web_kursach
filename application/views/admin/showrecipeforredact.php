<?php
$attributes = array(
	'class' => 'recipe_redact', 
	'id' => 'form_redact_recipe'
);
echo form_open('adminredact/redact/'.$item['recipe_id'], $attributes); 
?>
<label>Название</label>
<input type="text" name="recipe_description" value="<?=$item['description']?>"/>
<br />
<label>Ингридиенты</label>
<input type="text" name="recipe_ingredients" value="<?=$item['ingredients']?>"/>
<br />
<label>Рецепт</label>
<textarea rows="10" cols="80" name="recipe_recipe"><?=$item['recipe']?></textarea>
<br />
<input type="submit" name="recipe_redact_btn" value="Сохранить изменения в рецепте" />
<?php form_close();?>
<br />
<br />
<div id="comenst">
Коментарии пользователей
<br />
<br />
<?php
foreach ($coments as $item) {
?>
Пользователь : <?=$item->user['username'];?>&nbsp;&nbsp;
<a href="/adminuser/index/<?=$item->user['user_id']?>">Запретить коментировать</a>&nbsp;&nbsp;
<a href="/adminuser/give/<?=$item->user['user_id']?>">Разрешить коментировать</a>
<?php
$attributes = array(
	'class' => 'redact_coment', 
	'id' => 'form_redact_coment'
);
echo "<br />";
echo form_open('adminredact/redactcoment/'.$item->user['user_id'], $attributes);?>
	<label>Рецепт</label>
	<textarea rows="4" cols="80" name="coment_user"><?=$item->coment['coment']?></textarea>
	<br />
	<input type="submit" name="redact_coment_user" value="Сохранить изменения в коментарии" />
<?php echo form_close();
echo "<br />";
}
?>