<?php
$attributes = array(
    'class' => 'recipe_add', 
    'id' => 'form_add_recipe'
);
echo form_open('admin/addrecipe/add', $attributes); 
?>
<label>Название</label>
<input type="text" name="recipe_description" />
<br />
<label>Рецепт</label>
<textarea rows="10" cols="80" name="recipe_recipe"></textarea>
<br />
<input type="submit" name="recipe_add_btn" value="Отправить рецепт" />
<?php form_close();?>
</body>
</html>