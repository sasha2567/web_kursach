            <div id="templatemo_right_col">
                <?php 
				if(isset($username) && $username !== FALSE){?>
                <div id="container">
                	<h1 id="headerform"><?php if($lang == 'rus') echo 'Добавить тему'; else echo 'Add topic';?></h1>
                	
					<div id="body">
	                <?php
	                if($username != false){
							$attributes = array(
							    'class' => 'user_forum', 
							    'id' => 'form_forum_add'
							);
							echo form_open('forum/home/add', $attributes); 
					?>
							<input type="text" name="theme_name">
							<div id="submit">
								<input type="submit" name="user_theme_btn" value="<?php if($lang == 'rus') echo 'Создать тему'; else echo 'Post topic';?>" />
							</div>
					<?php
							echo form_close();

							echo validation_errors();
						}
					?>
					</div>
				</div>
				<?php
				}
				?>
            	<div id="container">
					<h1 id="headerform"><?php if($lang == 'rus') echo 'Темы форума'; else echo 'Themes';?></h1>
	            	<ul id="themes">
	            	<?php foreach ($themes as $item):?>
						<li>
							<a href="<?=base_url();?>forum/home/show/<?=$item['theme_id']?>">
								<div id="theme">
									<?=$item['theme']?>	
								</div>
								
							</a>
						</li>
					<?php endforeach; ?>
	            	</ul>
	                <div id="pagination">
	                	<?=$pagination;?>
	                </div>
                </div>