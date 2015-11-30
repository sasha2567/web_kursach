			<div id="templatemo_right_col">
				<div class="templatemo_post_area">
					<h1>Ближайший мастер-класс</h1>
				</div>
				<?php
				if(isset($master)){
				?>
					<div class="master">
						<h3>
							Тема: <?=$master['subject']?>
						</h3>
						<p>
							Описание: <?=$master['description']?>
						</p>
					</div>
					<?php
					if($username != false){
						$attributes = array(
						    'class' => 'user_master', 
						    'id' => 'form_master_login'
						);
						echo form_open('users/master/write', $attributes); 
					?>
						<input type="submit" name="user_master_btn" value="Записаться" />
					<?php
						echo form_close();
					}
				}
				else{
				?>
					<h3>
						Сейчас нет ни одного мастер-класса
					</h3>
				<?php
				}
				?>