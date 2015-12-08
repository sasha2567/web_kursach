<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="templatemo_right_col">
	<div class="templatemo_post_area">
	
		<div id="container">
			<h1 id="headerform"><?php if($lang == 'rus') echo 'Регистрация пользователя'; else echo 'User registr';?></h1>
			<?php 
			if(!isset($username) || $username === FALSE){?>
			<div id="body">
			<?php	
				$attributes = array(
				    'class' => 'user_registr', 
				    'id' => 'form_user_registr'
				);
				echo form_open('registration'); ?>

					<h5><?php if($lang == 'rus') echo 'Логин'; else echo 'Username';?></h5>
					<input type="text" name="username" value="" size="50" />

					<h5><?php if($lang == 'rus') echo 'Пароль'; else echo 'Password';?></h5>
					<input type="password" name="password" value="" size="50" />

					<h5><?php if($lang == 'rus') echo 'Повторите пароль'; else echo 'Password Confirm';?></h5>
					<input type="password" name="passconf" value="" size="50" />

					<h5><?php if($lang == 'rus') echo 'ФИО'; else echo 'FIO';?></h5>
					<input type="text" name="userfio" value="" size="50" />

					<h5>Email</h5>
					<input type="text" name="email" value="" size="50" />
					<br />
					<div id="submit">
						<input type="submit" value="<?php if($lang == 'rus') echo 'Отправить'; else echo 'Submit';?>" />
					</div>

				</form>

				<?php echo validation_errors(); ?>
			</div>
			<?php 
			}
			else
			{
			?>
				<p id="regfalse"><?php if($lang == 'rus') echo 'Вы уже зарегестрированы'; else echo 'You are already registr';?></p>
			<?php
			}
			?>
		</div>
	</div>