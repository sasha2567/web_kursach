<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
            <script type="text/javascript">
                var select_count = 0;
                var flag_hide = 0;
                var productsForSelect = [
            <?php
                    foreach ($product as $value) {
            ?>
                        {'id' :  <?=$value["product_id"];?>, 'product' : '<?=$value["description"];?>'},
            <?php
                    }
            ?>
                ];

                var typeForSelect = [
            <?php
                    foreach ($types as $value) {
            ?>
                        {'id' :  <?=$value["type_id"];?>, 'type' : '<?=$value["type"];?>'},
            <?php
                    }
            ?>
                ];

                function generateSelectIng (count, id) {
                    var text = '<select class="ing' + count + '" name="ingredients[' + count + '][product_id]">';
                    for (var i = 0; i < productsForSelect.length; i++) {
                        text += '<option value="' + productsForSelect[i]['id'] + '"';
                        if((id - 1) == i)
                            text += ' selected ';
                        text +=  '>' +productsForSelect[i]['product'] + '</option>';
                    };
                    text += '</select>';
                    return text;
                }

                function generateSelectType (count, id) {
                    var text = '<select class="type' + count + '" name="ingredients[' + count + '][type_id]">';
                    for (var i = 0; i < typeForSelect.length; i++) {
                        text += '<option value="' + typeForSelect[i]['id'] + '"'
                        if((id - 1) == i)
                            text += ' selected ';
                        text += '>' + typeForSelect[i]['type'] + '</option>';
                    };
                    text += '</select>';
                    return text;
                }

                function adddiv(id1, id2, val) {
                    $('#product'+ select_count).append(generateSelectIng(select_count, id1));
                    $('#product'+ select_count).append('<input class="count" type="text" name="ingredients[' + select_count + '][count]" value="' + val + '"/>');
                    $('#product'+ select_count).append(generateSelectType(select_count, id2));
                    select_count++;
                }

                function addd() {
                    $('#products').append('<br />');
                    $('#products').append('<div id="product' + select_count + '">');
                    $('#products').append('</div>');                    
                }

                function addnew() {
                    addd();
                    adddiv(1,1,0);
                }
            </script>
            <div id="templatemo_right_col">
                
                <div id="container">
                    <h1 id="headerform"><?=$item['description']?></h1>
                    <div id="body">
                        <div clacc="image">
                            <img src="<?=base_url();?>images/<?=$item['image']?>" height="150" width="150"/>
                        </div>
                        <h3 id="headerformh3"><?php if($lang == 'rus') echo 'Продукты:'; else echo 'Products:';?></h3>
                    <?php
                        if(isset($username) && $username !== FALSE){
                            $attributes = array(
                                    'class' => 'admin_redact', 
                                    'id' => 'form_admin_redact'
                                );
                                echo form_open('admin/admin_recipe/redact/'.$item['recipe_id'], $attributes);
                    ?>
                        <div id="redact_form">
                            <div id="products">
                    <?php
                                foreach ($products as $value) {
                    ?>
                                <script type="text/javascript">
                                    addd();
                                    adddiv(<?=$value['product_id'];?>, <?=$value['type_id'];?>, <?=$value['count'];?>);
                                </script>
                    <?php 
                                }
                    ?>
                                </div>
                                <br />
                                <input type="button" onclick="addnew()" value="<?php if($lang == 'rus') echo 'Добавить ингредиент'; else echo 'Add ingredient';?>">
                                <h3 id="headerformh3"><?php if($lang == 'rus') echo 'Рецепт:'; else echo 'Recipe:';?></h3>
                                <textarea rows="5" cols="63" name="recipe_recipe"><?=$item['recipe']?></textarea>
                                <div id="submit">
                                    <input type="submit" name="recipe_redact_btn" value="<?php if($lang == 'rus') echo 'Редактировать'; else echo 'Redact';?>" />
                                </div>
                            </div>
                        </div>
                    <?php 
                                echo form_close();
                                echo validation_errors();
                        }
                    ?>

                        <h3 id="headerformh3"><?php if($lang == 'rus') echo 'Коментарии:'; else echo 'Coments:';?></h3>
                        <div id="coments">
                            <?php
                            foreach ($coments as $value) {
                            ?>
                                <div id="coment">
                                    <h3>Пользователь : <?=$value->user['username'];?></h3>
                                    <h4><?=$value->coment['datetime']?></h4>
                                    <p><?=$value->coment['coment']?></p>
                                    <a href="<?=base_url();?>admin/admin_user/index/<?=$value->user['user_id']?>/<?=$item['recipe_id']?>"><?php if($lang == 'rus') echo 'Запретить коментировать'; else echo 'Disallow comments';?></a>
                                    <a href="<?=base_url();?>admin/admin_user/give/<?=$value->user['user_id']?>/<?=$item['recipe_id']?>"><?php if($lang == 'rus') echo 'Разрешить коментировать'; else echo 'Allow comments';?></a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        
                   </div>

                

                
                