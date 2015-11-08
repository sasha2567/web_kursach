            <div id="templatemo_right_col">
                 
            	<div class="templatemo_gallery">
                    <div clacc="image">
                        <img src="<?=base_url();?>images/<?=$item['image']?>" />
                    </div>

                    <div class="templatemo_title">
                        <?=$item['description']?>                        
               	  	</div>
                </div>
            	<div class="templatemo_post_area">
            		<?php
                    foreach ($products as $value) {
                    ?>
                    <h1><?=$value['product']." : ".$value['count']." ".$value['type']?></h1>
                    <?php 
                    }
                    ?>
            	</div>
            	<p>
                    <?=$item['recipe']?>
                </p> 

            	<div class="templatemo_section">
            	<?php
				foreach ($coments as $value) {
				?>
                	<h1>Пользователь : <?=$value->user['username'];?></h1>
                    <h2><?=$value->coment['datetime']?></h2>
                    <p><?=$value->coment['coment']?></p>
                <?php
                }
                ?>
                </div>
                <?php
                    if(isset($username) && $username !== FALSE){
                ?>
                        <div id="coment_form">
                <?php
                        $attributes = array(
                            'class' => 'user_login', 
                            'id' => 'form_add_coment'
                        );
                        echo form_open('users/recipes/addcoment/'.$item['recipe_id'], $attributes); 
                ?>
                            <label>Коментарий</label>
                            <textarea rows="4" cols="68" name="coment_user"></textarea>
                            <br />
                            <input type="submit" name="add_coment_user" value="Добавить коментарий" />
                        
                <?php 
                        echo form_close();
                    }
                ?>
                        </div>