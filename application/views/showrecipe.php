            <div id="templatemo_right_col">
                 
            	<div class="templatemo_gallery">
                    <div class="templatemo_title">
                     	<?=$item['description']?>                        
               	  	</div>
                </div>
            	<div class="templatemo_post_area">
            		<h1><?=$item['ingredients']?></h1>
            	</div>
            	<?=$item['recipe']?>
            	<div class="templatemo_section">
            	<?php
				foreach ($coments as $item) {
				?>
                	<h1>Пользователь : <?=$item->user['username'];?></h1>
                    <h2><?=$item->coment['datetime']?></h2>
                    <p><?=$item->coment['coment']?></p>
                <?php
                }
                ?>
                <br />
                <?php
					$attributes = array(
						'class' => 'add_coment', 
						'id' => 'form_add_coment'
					);
					echo "<br />";
					echo form_open('/users/recipes/addcoment/'.$item->user['user_id'], $attributes);?>
						<label>Коментарий</label>
						<textarea rows="4" cols="80" name="coment_user"></textarea>
						<br />
						<input type="submit" name="add_coment_user" value="Добавить коментарий" />
				<?php form_close();?>
                </div>