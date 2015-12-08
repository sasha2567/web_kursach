<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
			<div id="templatemo_right_col">
				
				<?php
				if(isset($masters)){
					foreach ($masters as $value) {
				?>
					<div id="container">
						<div id="body">
					
							<div id="master">
								<h1 id="headerform"><?php if($lang == 'rus') echo 'Тема'; else echo 'Subject';?>: <?=$value['subject']?></h1>
								<h5><?php if($lang == 'rus') echo 'Дата проведения'; else echo 'Provide date';?>: <?=$value['dateprovide']?></h5>
								<p>
									<?php if($lang == 'rus') echo 'Описание'; else echo 'Description';?>: <?=$value['description']?>
								</p>
								
							</div>
				<?php
							if(isset($username) && $username !== FALSE){
								$attributes = array(
								    'class' => 'user_master', 
								    'id' => 'form_master_login'
								);
								echo form_open('user/user_master/write/'.$value["master_id"], $attributes); 
				?>
								<div id="submit">
									<input type="submit" name="user_master_btn" value="<?php if($lang == 'rus') echo 'Записаться'; else echo 'Follow';?>" />
								</div>
				<?php
								echo form_close();
							}
				?>
						</div>
					</div>
				<?php
					}
				?>
					
				<?php
				}
				else{
				?>
					<div id="container">
						<div id="body">
							<?php if($lang == 'rus') echo 'Сейчас нет ни одного мастер-класса'; else echo 'Nothind master-classes';?>
						</div>
					</div>
				<?php
				}
				?>