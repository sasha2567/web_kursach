<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
			<script type="text/javascript">
				var input_count = 0;
				
				function add() {
					$('#ingredientsDiv').append('<br />');
					$('#ingredientsDiv').append('<input type="text" name="ingredients[' + (input_count + 1) + ']"/>');

					input_count++;
				}
			</script>
            <div id="templatemo_right_col">
                
                <div id="container">
					<h1 id="headerform"><?php if($lang == 'rus') echo 'Поиск по названию'; else echo 'Search by title';?></h1>
                	<div id="body">
                	<?php
						$attributes = array(
						    'class' => 'user_search', 
						    'id' => 'form_user_searc'
						);
						echo form_open('user/user_search/search', $attributes); 
					?>
							<input type="text" name="search_text" />
							<div id="submit">
								<input type="submit" name="user_search_btn" id="btn_search" value="<?php if($lang == 'rus') echo 'Найти'; else echo 'Search';?>" />
							</div>
					<?php 
						echo form_close();

						echo validation_errors();
					?>
					</div>
					<h3 id="headerformh3"><?php if($lang == 'rus') echo 'Или'; else echo 'Or';?></h3>
					<h1 id="headerform"><?php if($lang == 'rus') echo 'Поиск по ингредиентам'; else echo 'Search by ingredients';?></h1>
                	<div id="body">
					<?php
						$attributes = array(
						    'class' => 'user_search_recipe', 
						    'id' => 'form_user_searc_recipe'
						);
						echo form_open('user/user_search/recipesearch', $attributes); 
					?>
							<input type="button" name="add_ing" onclick="add()" value="<?php if($lang == 'rus') echo 'Добавить ингредиент'; else echo 'Add ingredient';?>" />
							<div id="ingredientsDiv">
								<input type="text" name="ingredients[0]" />
							</div>
							<div id="submit">
								<input type="submit" name="user_search_recipe_btn" id="btn_search_recipe" value="<?php if($lang == 'rus') echo 'Найти'; else echo 'Search';?>" />
							</div>
					<?php 
						echo form_close();

						echo validation_errors();
					?>
                	</div>
                </div>
                <?php
                if(isset($searchflag) && $searchflag == 1){
				?>
					<div id="container">
						<h1 id="headerform"><?php if($lang == 'rus') echo 'Рецепты'; else echo 'Recipes';?></h1>
                		<div id="body">
	            			<ul id="recipes">
	            <?php foreach ($recipes as $item):?>
								<li>
									<a href="<?=base_url();?>user/user_recipe/show/<?=$item['recipe_id']?>">
										<img src="<?=base_url();?>images/<?=$item['image']?>" height="150" width="150"/>
									</a>
									&nbsp;
									<a href="<?=base_url();?>user/user_recipe/show/<?=$item['recipe_id']?>">
										<?=$item['description']?>
									</a>
								</li>
				<?php endforeach; ?>
	            			</ul>
			                <div id="pagination">
			                	<?=$pagination;?>
			                </div>
	                	</div>
	                </div>
	            <?php 
            	}
            	else{
            	?>
            		<div id="container">
						<h3 id="headerformh3"><?php if($lang == 'rus') echo 'Ничего не найдено'; else echo 'Nothing to search';?></h3>
					</div>
            	<?php
            	}
            	?>