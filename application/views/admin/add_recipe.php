<script type="text/javascript">
	var select_count = 1;
	var input_count = 1;
	var select_array = new Array(0,0);
	var input_array = new Array(0,0);

	function form_add_select_product (id) {
		if(select_array[id] == 0){
			var divname = document.getElementById("ingredients");
			
			divname.innerHTML += '<br /><select id="ing_' + (select_count + 1) + '" onchange="form_add_select_product(' + (select_count + 1) + ')">' +
			<?php
				foreach ($products as $value) {
			?>
					'<option value="<?=$value["product_id"];?>"><?=$value["description"];?></option>' +
			<?php
				}
			?>
			'</select>' +
			'<input type="text" name="recipe_count_ing_' + (select_count + 1) + '"/>' +
			'<select id="type_' + (select_count + 1) + '">' +
			<?php
				foreach ($types as $value) {
			?>
					'<option value="<?=$value["type_id"];?>"><?=$value["type"];?></option>'+
			<?php
				}
			?>
			'</select>';
			select_array[id] = 1;
			select_count++;
		}
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
<select>
  <option value="1">На каждый день</option>
  <option value="2">На праздник</option>
</select>
<div id="ingredients">
	<select id="ing_1" onchange="form_add_select_product(1)">
	<?php
		foreach ($products as $value) {
	?>
			<option value="<?=$value['product_id'];?>"><?=$value['description'];?></option>
	<?php
		}
	?>
	</select>
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
<div id="new_ingredients">
	<input type="text" name="recipe_new_ing_1" onblur="form_add_input_product(1)" />
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