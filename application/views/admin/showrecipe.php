<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
            <div id="templatemo_right_col">
                 
            	<div id="container">
					<h1 id="headerform"><?php if($lang == 'rus') echo 'Рецепты'; else echo 'Recipes';?></h1>
            		<div id="body">
            			<ul id="recipes">
            	<?php foreach ($recipes as $item):?>
							<li>
								<a id="del_rec" href="<?=base_url();?>admin/admin_home/deleterecipe/<?=$item['recipe_id']?>">
									<?php if($lang == 'rus') echo 'Удалить'; else echo 'Delete';?>
								</a>
								<br />
								<img src="<?=base_url();?>images/<?=$item['image']?>" height="150" width="150"/>
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