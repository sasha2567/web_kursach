<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
            <div id="templatemo_right_col">
                
                <div id="container">
					<h1 id="headerform"><?php if($lang == 'rus') echo 'Поиск по названию'; else echo 'Search by title';?></h1>
                	<div id="body">
                	<?php
						$attributes = array(
						    'class' => 'user_search', 
						    'id' => 'form_user_searc'
						);
						echo form_open('admin/admin_search/search', $attributes); 
					?>
							<input type="text" name="search_text" />
							<div id="submit">
								<input type="submit" name="admin_search_btn" id="btn_search" value="<?php if($lang == 'rus') echo 'Найти'; else echo 'Search';?>" />
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
									<a href="<?=base_url();?>admin/admin_recipe/show/<?=$item['recipe_id']?>">
										<img src="<?=base_url();?>images/<?=$item['image']?>" height="150" width="150"/>
									</a>
									&nbsp;
									<a href="<?=base_url();?>admin/admin_recipe/show/<?=$item['recipe_id']?>">
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