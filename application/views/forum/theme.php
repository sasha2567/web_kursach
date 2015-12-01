            <div id="templatemo_right_col">
                
                <div id="title">
                	<h2>
                		<?=$themeName?>
                	</h2>
                </div>
                <?php
                if($username != false){
						$attributes = array(
						    'class' => 'user_messege', 
						    'id' => 'form_forum_messege'
						);
						echo form_open('forum/home/addmessege/'.$themeId, $attributes); 
					?>
						<input type="text" name="user_messege">
						<input type="submit" name="user_messege_btn" value="Написать сообщение" />
					<?php
						echo form_close();
					}
				?>
            	<div class="templatemo_post_area">
            		<h1>Сообщения</h1>
            	</div>
            	<ul>
            	<?php foreach ($messeges as $item):?>
					<li>
						<div>
							<p>
								<?=$item['username']?>
							</p>
							<?=$item['messege']?>	
						</div>
							
					</li>
				<?php endforeach; ?>
            	</ul>