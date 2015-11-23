			<div id="templatemo_right_col">
                 
            	<div class="templatemo_post_area">
            		<h1>Список рецептов</h1>
            	</div>
                <ul>
				<?php foreach ($recipes as $item):?>
					<li>
						<a href="<?=base_url();?>admin/redact/show/<?=$item['recipe_id']?>">
							<img src="<?=base_url();?>images/<?=$item['image']?>" height="150" width="150"/>
						</a>
						&nbsp;
						<a href="<?=base_url();?>admin/redact/show/<?=$item['recipe_id']?>">
							<?=$item['description']?>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
				<div id="pagination">
                	<?php 
	                	for ($i=1; $i <= $recordCount + 1; $i++):
                	?>
                			<a href="<?=base_url();?>admin/recipelist/index/<?=$i?>"><?=$i?></a>
                	<?php endfor; ?>
                </div>