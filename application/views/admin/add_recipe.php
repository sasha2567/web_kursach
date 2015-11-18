<script type="text/javascript">
	var select_count = 1;
	var input_count = 1;

	function add() {
		var idsIn = 'ing_' + select_count;
		var indIn = document.getElementById(idsIn).selectedIndex + 1;
		var idsTy = 'type_' + select_count;
		var indTy = document.getElementById(idsTy).selectedIndex + 1;
		var col = new Array();
		for (var i = 1; i <= select_count; i++) {
			col[i] = document.getElementById('recipe_count_ing_' + i).value;
		};
		document.getElementById('recipe_count_ing_' + select_count).value;
		var divname = document.getElementById("ingredients");
		
		divname.innerHTML += '<br /><select id="ing_' + (select_count + 1) + '" name="ingredient_' + (select_count + 1) + '">' +
		<?php
			foreach ($products as $value) {
		?>
				'<option value="<?=$value["product_id"];?>"><?=$value["description"];?></option>' +
		<?php
			}
		?>
		'</select>' +
		'<input type="text" name="recipe_count_ing_' + (select_count + 1) + '" id="recipe_count_ing_' + (select_count + 1) + '"/>' +
		'<select id="type_' + (select_count + 1) + '" name="type_' + (select_count + 1) + '>' +
		<?php
			foreach ($types as $value) {
		?>
				'<option value="<?=$value["type_id"];?>"><?=$value["type"];?></option>'+
		<?php
			}
		?>
		'</select>';
		$('#' + idsIn + ' :nth-child(' + indIn + ')').attr("selected", "selected");
		$('#' + idsTy + ' :nth-child(' + indTy + ')').attr("selected", "selected");
		for (var i = 1; i <= select_count; i++) {
			document.getElementById('recipe_count_ing_' + i).value = col[i];
		}
		$('#' + idsIn).attr("disabled","disabled");
		$('#' + idsTy).attr("disabled","disabled");
		select_count++;
	}
</script>
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
<input type="file" name="recipe_image" />
<br />
<select name="select_section">
  <option value="1">На каждый день</option>
  <option value="2">На праздник</option>
</select>
<div id="ingredients">
	<select id="ing_1" name="ingredient_1">
	<?php
		foreach ($products as $value) {
	?>
			<option value="<?=$value['product_id'];?>"><?=$value['description'];?></option>
	<?php
		}
	?>
	</select>
	<input type="text" name="recipe_count_ing_1" id="recipe_count_ing_1"/>
	<select id="type_1" name="type_1">
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
	<input type="text" name="recipe_new_ing_1" onblur="form_add_input_product(1)" name="new_ingredient_1" />
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
<label>Рецепт</label>
<textarea rows="10" cols="80" name="recipe_recipe"></textarea>
<br />
<input type="submit" name="recipe_add_btn" value="Отправить рецепт" />
<?php 
echo form_close();
?>