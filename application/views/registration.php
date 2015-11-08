			<div id="templatemo_right_col">
				<div class="templatemo_post_area">
					<h1>Регистрация</h1>
					<?php
						if(!isset($username) || $username === FALSE){
							$attributes = array(
							    'class' => 'user_registr', 
							    'id' => 'form_user_registr'
							);
							echo form_open('registration/registrated', $attributes); 
							?>
							<label>Имя пользователя/Логин</label>
							<input type="text" name="user_name" />
							<br />
							<label>Пароль</label>
							<input type="password" name="user_password1" />
							<br />
							<label>Повторите пароль</label>
							<input type="password" name="user_password2" />
							<br />
							<label>ФИО</label>
							<input type="text" name="user_fio" />
							<br />
							<label>E-mail</label>
							<input type="text" name="user_mail" />
							<br />
							<input type="submit" name="user_registr_btn" id="btn_reg" value="Зарегестрироваться" />
					<?php 
							echo form_close();
						}
						else{
					?>
							<p>Вы уже зарегестрированны</p>
					<?php
						}
					?>
				</div>