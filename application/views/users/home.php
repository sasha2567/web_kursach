            <div id="templatemo_right_col">
                 
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
                			if ($pageIndex == 1){
	                ?> 
                				<a href="<?=base_url();?>users/news/index/<?=$i?>"
                					<?php 
										if($i == $currentPage) 
											echo 'class="current"';
									?>
                				><?=$i?></a>
	                <?php
                			}
                			if ($pageIndex == 2){
	                ?> 
                				<a href="<?=base_url();?>users/feast/index/<?=$i?>"
                					<?php 
										if($i == $currentPage) 
											echo 'class="current"';
									?>
                				><?=$i?></a>
	                <?php
                			}
                			if ($pageIndex == 3){
	                ?> 
                				<a href="<?=base_url();?>users/daily/index/<?=$i?>"
                					<?php 
										if($i == $currentPage) 
											echo 'class="current"';
									?>
                				><?=$i?></a>
	                <?php
                			}
                		endfor; ?>
                </div>