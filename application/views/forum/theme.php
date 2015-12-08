            <div id="templatemo_right_col">
                <div id="container">
                	<h1 id="headerform"><?php if($lang == 'rus') echo 'Тема: '; else echo 'Theme: ';?><?=$themeName?></h1>
                	<div id="body">
	                	<h3 id="headerformh3"><?php if($lang == 'rus') echo 'Сообщения:'; else echo 'Messages';?></h3>
		            	<ul id="themes">
		            	<?php foreach ($messeges as $item):?>
							<li>
								<div id="message">
									<p>
										<?=$item['username']?>
									</p>
									<h3><?=$item['messege']?></h3>
								</div>
									
							</li>
						<?php endforeach; ?>
		            	</ul>
		            </div>
                </div>
                <?php
	            if($username != false){?>
                <div id="container">
                	<h3 id="headerformh3"><?php if($lang == 'rus') echo 'Добавить сообщение:'; else echo 'Add message';?></h3>
					<div id="body">
	                <?php
							$attributes = array(
							    'class' => 'user_messege', 
							    'id' => 'form_forum_messege'
							);
							echo form_open('forum/home/addmessege/'.$themeId, $attributes); 
						?>
							<input type="text" name="user_messege">
							<div id="submit">
								<input type="submit" name="user_messege_btn" value="<?php if($lang == 'rus') echo 'Написать сообщение'; else echo 'Send message';?>" />
							</div>
						<?php
							echo form_close();

							echo validation_errors();?>
					</div>
				</div>
				<?php
				}
				?>
	            	