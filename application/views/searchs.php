            <div id="templatemo_right_col">
                <div id="form_search">
                	<?php
						$attributes = array(
						    'class' => 'user_search', 
						    'id' => 'form_user_searc'
						);
						echo form_open('users/searchs/search', $attributes); 
					?>
							<input type="text" name="search_text" />
							<input type="submit" name="user_search_btn" id="btn_search" value="Найти" />
					<?php 
						echo form_close();
					?>
                </div>
                <?php
                if(isset($searchflag) && $searchflag == 1){
				?>
            	<div class="templatemo_post_area">
            		<h1>Рецепты</h1>
            	</div>
            	<ul>
            	<?php foreach ($recipes as $item):?>
					<li>
						<a href="<?=base_url();?>users/recipes/show/<?=$item['recipe_id']?>">
							<img src="<?=base_url();?>images/<?=$item['image']?>" height="150" width="150"/>
						</a>
						&nbsp;
						<a href="<?=base_url();?>users/recipes/show/<?=$item['recipe_id']?>">
							<?=$item['description']?>
						</a>
					</li>
				<?php endforeach; ?>
            	</ul>
                <div id="pagination">
                	<?php
	                	for ($i=1; $i <= $recordCount + 1; $i++):
                			if ($pageIndex == 4){
	                ?> 
                				<a href="<?=base_url();?>users/searchs/search/<?=$i?>"
                					<?php 
										if($i == $currentPage) 
											echo 'class="current"';
									?>
                				><?=$i?></a>
	                <?php
                			}
                		endfor; ?>
                </div>
                <?php 
            	}
            	?>