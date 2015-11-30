            <div id="templatemo_right_col">
                
                <?php
                if($username != false){
						$attributes = array(
						    'class' => 'user_master', 
						    'id' => 'form_master_login'
						);
						echo form_open('forum/home/add', $attributes); 
					?>
						<input type="text" name="theme_name">
						<input type="submit" name="user_theme_btn" value="Создать тему" />
					<?php
						echo form_close();
					}
				?>
            	<div class="templatemo_post_area">
            		<h1>Темы</h1>
            	</div>
            	<ul>
            	<?php foreach ($themes as $item):?>
					<li>
						<a href="<?=base_url();?>forum/home/show/<?=$item['theme_id']?>">
							<div>
								<?=$item['theme']?>	
							</div>
							
						</a>
					</li>
				<?php endforeach; ?>
            	</ul>
                <div id="pagination">
                <?php
	                	for ($i=1; $i <= $recordCount + 1; $i++):
                			if ($pageIndex == 1){
	            ?> 
                				<a href="<?=base_url();?>forum/index/<?=$i?>"
                <?php 
										if($i == $currentPage) 
											echo 'class="current"';
				?>
                				><?=$i?></a>
	            <?php
                			}
                		endfor; 
                ?>
                </div>