			<div id="templatemo_right_col">
                 
            	<div class="templatemo_post_area">
            		<h1>Список рецептов</h1>
            	</div>
                <ol>
				<?php foreach ($recipes as $item):?>
					<li>
						<a href="<?=base_url();?>admin/redact/show/<?=$item['recipe_id']?>">
							<img src="<?=base_url();?>images/<?=$item['image']?>" />
						</a>
						&nbsp;
						<a href="<?=base_url();?>admin/redact/show/<?=$item['recipe_id']?>">
							<?=$item['description']?>
						</a>
					</li>
				<?php endforeach; ?>
				</ol>