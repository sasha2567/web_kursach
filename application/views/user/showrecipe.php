<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
            <div id="templatemo_right_col">
                
            	<div id="container">
                    <h1 id="headerform"><?=$item['description']?></h1>
                    <div id="body">
                        <div clacc="image">
                            <img src="<?=base_url();?>images/<?=$item['image']?>" height="150" width="150"/>
                        </div>
                        <h3 id="headerformh3"><?php if($lang == 'rus') echo 'Продукты:'; else echo 'Products:';?></h3>
                		<div id="products">
                            <?php
                            foreach ($products as $value) {
                            ?>
                            <h3><?=$value['product']." : ".$value['count']." ".$value['type']?></h3>
                            <?php 
                            }
                            ?>
                        </div>
                        <h3 id="headerformh3"><?php if($lang == 'rus') echo 'Рецепт:'; else echo 'Recipe:';?></h3>
                        <p class="recipe">
                            <?=$item['recipe']?>
                        </p>
                        <h3 id="headerformh3"><?php if($lang == 'rus') echo 'Коментарии:'; else echo 'Coments:';?></h3>
                        <div id="coments">
                            <?php
                            foreach ($coments as $value) {
                            ?>
                                <div id="coment">
                                    <h3>Пользователь : <?=$value->user['username'];?></h3>
                                    <h4><?=$value->coment['datetime']?></h4>
                                    <p><?=$value->coment['coment']?></p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                            if(isset($username) && $username !== FALSE && $comented == 1){
                        ?>
                                <div id="coment_form">
                        <?php
                                $attributes = array(
                                    'class' => 'user_login', 
                                    'id' => 'form_add_coment'
                                );
                                echo form_open('user/user_recipe/addcoment/'.$item['recipe_id'], $attributes); 
                        ?>
                                    <h3 id="headerformh3"><?php if($lang == 'rus') echo 'Добавьте свой коментарий:'; else echo 'Add your comment:';?></h3>
                                    <textarea rows="5" cols="63" name="coment_user"></textarea>
                                    <div id="submit">
                                        <input type="submit" name="add_coment_user" value="<?php if($lang == 'rus') echo 'Добавить коментарий'; else echo 'Add coment';?>" />
                                    </div>
                                
                        <?php 
                                echo form_close();
                                echo validation_errors();
                            }
                        ?>
                                </div> 
            	   </div>