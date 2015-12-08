<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
            <div id="templatemo_right_col">
                 
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