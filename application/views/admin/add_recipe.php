<script type="text/javascript">
	var select_count = 0;
	var input_count = 0;
	
	var productsForSelect = [

	<?php
		foreach ($products as $value) {
	?>
			{'id' :  <?=$value["product_id"];?>, 'product' : '<?=$value["description"];?>'},
	<?php
		}
	?>
	];
	var length = productsForSelect.length;

	var typeForSelect = [
	<?php
		foreach ($types as $value) {
	?>
			{'id' :  <?=$value["type_id"];?>, 'type' : '<?=$value["type"];?>'},
	<?php
		}
	?>
	];

	function generateSelectIng (inmass, count) {
		var text = '<select id="ing_' + count + '" name="ingredients[' + count + '][product_id]">';
		for (var i = 0; i < length; i++) {
			text += '<option value="' + inmass[i]['id'] + '" >' + inmass[i]['product'] + '</option>';
		};
		text += '</select>';
		return text;
	}

	function generateSelectType (inmass, count) {
		var text = '<select id="type_' + count + '" name="ingredients[' + count + '][type_id]">';
		for (var i = 0; i < length; i++) {
			text += '<option value="' + inmass[i]['id'] + '" >' + inmass[i]['type'] + '</option>';
		};
		text += '</select>';
		return text;
	}

	function deleteProductAsIndex (productsForSelect, index) {
		for (var i = index; i < length - 1; i++) {
			productsForSelect[i] = productsForSelect[i + 1];
		};
		length--;
	}

	function add() {
		var idsIn = 'ing_' + select_count;

		var indIn = document.getElementById(idsIn).selectedIndex + 1;

		deleteProductAsIndex(productsForSelect,(indIn - 1));
		if(length > 0){
			$('#ingredientsDiv').append('<br />');
			$('#ingredientsDiv').append(generateSelectIng(productsForSelect,(select_count + 1)));
			$('#ingredientsDiv').append('<input type="text" name="ingredients[' + (select_count + 1) + '][count]" id="recipe_count_ing_' + (select_count + 1) + '"/>');
			$('#ingredientsDiv').append(generateSelectType(typeForSelect,(select_count + 1)));

			select_count++;
		}
	}
</script>
<?php
$attributes = array(
    'class' => 'recipe_add', 
    'id' => 'form_add_recipe',
	'enctype' => "multipart/form-data"    
);
echo form_open('admin/addrecipe/add', $attributes); 

?>
<label>Название</label>
<input type="text" name="recipe_description" />
<br />
<input type="file" name="recipe_image" />
<br />
<select name="select_section">
  <option value="1">На каждый день</option>
  <option value="2">На праздник</option>
</select>
<div id="ingredientsDiv">
	<select id="ing_0" name="ingredients[0][product_id]">
	<?php
		foreach ($products as $value) {
	?>
			<option value="<?=$value['product_id'];?>"><?=$value['description'];?></option>
	<?php
		}
	?>
	</select>
	<input type="text" name="ingredients[0][count]" id="recipe_count_ing_0"/>
	<select id="type_0" name="ingredients[0][type_id]">
	<?php
		foreach ($types as $value) {
	?>
			<option value="<?=$value['type_id'];?>"><?=$value['type'];?></option>
	<?php
		}
	?>
	</select>
</div>
<input type="button" name="add_ing" onclick="add()" value="Добавить ингредиент" />
<div id="new_ingredients">
	<input type="text" name="recipe_new_ing_1" onblur="" name="new_ingredient_1" />
	<input type="text" name="recipe_count_ing_1"/>
	<select id="type_1">
	<?php
		foreach ($types as $value) {
	?>
			<option value="<?=$value['type_id'];?>"><?=$value['type'];?></option>
	<?php
		}
	?>
	</select>
</div>
<input type="button" name="add_ing_new" onclick="add_new()" value="Добавить ингредиент" />
<label>Рецепт</label>
<textarea rows="10" cols="80" name="recipe_recipe"></textarea>
<br />
<input type="submit" name="recipe_add_btn" value="Отправить рецепт" />
<?php 
echo form_close();
?>