<script type="text/javascript">
	var select_count = 0;
	var input_count = 0;
	var flag_hide = 0;
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
		for (var i = 0; i < typeForSelect.length; i++) {
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
			$('#ingredientsDiv').append('<br />');
			$('#ingredientsDiv').append(generateSelectIng(productsForSelect,(select_count + 1)));
			$('#ingredientsDiv').append('<input type="text" name="ingredients[' + (select_count + 1) + '][count]" id="recipe_count_ing_' + (select_count + 1) + '"/>');
			$('#ingredientsDiv').append(generateSelectType(typeForSelect,(select_count + 1)));

			select_count++;
		}
	}

	function generateType (inmass, count) {
		var text = '<select id="type_' + count + '" name="new_ingredient[' + count + '][type_id]">';
		for (var i = 0; i < length; i++) {
			text += '<option value="' + inmass[i]['id'] + '" >' + inmass[i]['type'] + '</option>';
		};
		text += '</select>';
		return text;
	}

	function addinput() {
		$('#new_ingredients').append('<br />');
		$('#new_ingredients').append('<input type="text" name="new_ingredient[' + (select_count + 1) + '][name]"/>');
		$('#new_ingredients').append('<input type="text" name="new_ingredient[' + (select_count + 1) + '][count]"/>');
		$('#new_ingredients').append(generateType(typeForSelect,(select_count + 1)));

		select_count++;

	}

	function news () {
		if(flag_hide == 0){
			$('#new_ingredients').show(1000);
			$('#new_ingredients').children().prop('disabled', false);
			$('#add_new_ing').show(1000);
			flag_hide = 1;
		}
	}
</script>
<div id="templatemo_right_col">
	<div id="container">
		<h1 id="headerform"><?php if($lang == 'rus') echo 'Добавление рецепта'; else echo 'Add recipe';?></h1>
		<div id="body">
		<?php
			$attributes = array(
			    'class' => 'recipe_add', 
			    'id' => 'form_add_recipe',
				'enctype' => "multipart/form-data"    
			);
			echo form_open('admin/admin_recipe/add', $attributes); 
		?>
			<h4><?php if($lang == 'rus') echo 'Название'; else echo 'Title';?></h4>
			<input type="text" name="recipe_description" />

			<h4><?php if($lang == 'rus') echo 'Картинка'; else echo 'Image';?></h4>
			<input type="file" name="recipe_image" />

			<h4><?php if($lang == 'rus') echo 'Раздел'; else echo 'Section';?></h4>
			<select name="select_section">
			  <option value="1">На каждый день</option>
			  <option value="2">На праздник</option>
			</select>
			<h4><?php if($lang == 'rus') echo 'Ингредиенты'; else echo 'Ingredients';?></h4>
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
			<h4 onclick="news()"><?php if($lang == 'rus') echo 'Новые ингредиенты'; else echo 'New ingredients';?></h4>
			<div id="new_ingredients" hidden="true">
				<input disabled="disabled" type="text" name="new_ingredient[0][name]" />
				<input disabled="disabled" type="text" name="new_ingredient[0][count]"/>
				<select disabled="disabled" name="new_ingredient[0][type_id]">
		<?php
					foreach ($types as $value) {
		?>
						<option value="<?=$value['type_id'];?>"><?=$value['type'];?></option>
		<?php
					}
		?>
				</select>
			</div>
			<input hidden="true" id="add_new_ing" type="button" name="add_ing_new" onclick="addinput()" value="Добавить ингредиент" />
			<h4><?php if($lang == 'rus') echo 'Рецепт'; else echo 'Recipe';?></h4>
			<textarea rows="10" cols="63" name="recipe_recipe"></textarea>
			<div id="submit">
				<input type="submit" name="recipe_add_btn" value="Отправить рецепт" />
			</div>
		<?php 
			echo form_close();

			echo validation_errors();
		?>
		</div>
	</div>





