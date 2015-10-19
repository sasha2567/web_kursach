<?php 
	require_once 'menu.php';
?>
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
					echo form_open('/users/recipe/show/addcoment/'.$item->user['user_id'], $attributes);?>
						<label>Коментарий</label>
						<textarea rows="4" cols="80" name="coment_user"></textarea>
						<br />
						<input type="submit" name="add_coment_user" value="Сохранить изменения в коментарии" />
				<?php form_close();?>
                </div>
                
            </div><!-- End Of Right -->
            <div class="cleaner"></div>
            
            <div id="templatemo_footer">Copyright © 2024 <a href="#">Your Company Name</a> | Designed by <a href="http://www.templatemo.com" target="_parent">Free CSS Templates</a></div>
            
            <div class="cleaner"></div>
        </div><!-- End Of Content Area -->    
    </div><!-- End Of Container -->
<!--  Free CSS Templates by TemplateMo.com  -->
</body>
</html>