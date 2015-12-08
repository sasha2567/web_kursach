<?php
	$uri = $_SERVER['PHP_SELF'];
	$uri = substr($uri, 11);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	<?=$title;?>
</title>
<meta name="keywords" content="free design template, download web templates, Fruit And Juice Website, XHTML, CSS" />
<meta name="description" content="Fruit And Juice - Free CSS Template, Free XHTML CSS Design Layout" />
<link href="/templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>highslide/highslide.css" />
<script type="text/javascript" src="<?=base_url();?>highslide/highslide-with-gallery.js"></script>
<script type="text/javascript" src="<?=base_url();?>highslide/jquery.js"></script>
<script type="text/javascript">

	hs.graphicsDir = 'highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.wrapperClassName = 'dark borderless floating-caption';
	hs.fadeInOut = true;
	hs.dimmingOpacity = .75;

	if (hs.addSlideshow) hs.addSlideshow({
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: .6,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
</script>
</head>
<body>
	
	<div id="templatemo_container">
		<div id="lang_div">
			<a href="<?=base_url();?>language/index/1">rus</a>
			<a href="<?=base_url();?>language/index/2">eng</a>
		</div>
		<div id="autorise">
			<?php
			if(!isset($username) || $username === FALSE){
				$attributes = array(
				    'class' => 'user_login', 
				    'id' => 'form_user_login'
				);
				echo form_open('login/logined', $attributes); 
				?>
				<label><?php if($lang == 'rus') echo "Имя пользователя"; else echo "User name";?></label>
				<input type="text" name="username" />
				<label><?php if($lang == 'rus') echo "Пароль"; else echo "Password";?></label>
				<input type="password" name="user_password" />
				<input type="submit" name="user_login_btn" id="btn_log" value="<?php if($lang == 'rus') echo 'Войти'; else echo 'Login';?>" />
			<?php 
				echo form_close();
			?>
				<div id="registr">
					<a href="<?=base_url();?>registration"><?php if($lang == 'rus') echo "Зарегестрируются"; else echo "Registrated";?></a>
				</div>
			<?php
			}
			else
			{
			?>
				<h3><?php if($lang == 'rus') echo 'Здраствуйте'; else echo 'Hello';?>: <?=$username;?></h3>
			<?php
				$attributes = array(
				    'class' => 'user_login',
				    'id' => 'form_user_login'
				);
				echo form_open('login/exitlog', $attributes);
			?>
				<input type="submit" name="user_login_btn" id="btn_log" value="<?php if($lang == 'rus') echo 'Выйти'; else echo 'Logout';?>" />
			<?php
				echo form_close();
			}
			?>
			
		</div>
		<div id="templatemo_header">
			<div id="templatemo_menu">
				<ul>
					<li>
						<a href="<?=base_url();?>admin/admin_home" 
							<?php if($pageIndex == 0)
								echo 'class="current"';
							?>
						>
							<?php if($lang == 'rus') echo 'Главная страница'; else echo 'Main page';?>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>admin/admin_search/index" 
							<?php if($pageIndex == 1)
								echo 'class="current"';
							?>
						>
							<?php if($lang == 'rus') echo 'Поиск рецептов'; else echo 'Search recipe';?>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>admin/admin_recipe/showadd" 
							<?php if($pageIndex == 2)
								echo 'class="current"';
							?>
						>
							<?php if($lang == 'rus') echo 'Добавление рецепта'; else echo 'Add recipe';?>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>admin/admin_home/listrecipe" 
							<?php if($pageIndex == 3)
								echo 'class="current"';
							?>
						>
							<?php if($lang == 'rus') echo 'Список рецептов'; else echo 'List of recipes';?>
						</a>
					</li>
					<li>
						<a href="<?=base_url();?>admin/admin_master" 
							<?php if($pageIndex == 4)
								echo 'class="current"';
							?>
						>
							<?php if($lang == 'rus') echo 'Мастер-класс'; else echo 'Master-class';?>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="templatemo_content_area">	
			<div id="templatemo_left_col">
				<div class="templatemo_section">
					<h1>Последнии коментарии</h1>
						<?php
						if(isset($titlecoment)){
							foreach ($titlecoment as $value) {?>
								<h2><?=$value['user']['username'];?></h2>
								<p><?=$value['coment']['coment'];?></p>
						<?php
							}
						}
						?>
						
						
				</div>
				<div class="templatemo_section">
					<h1>W3C Validators</h1>
					<p>
						<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" width="88" height="31" border="0" /></a>
						<a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px" alt="Valid CSS" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" /></a>
					</p> 
				</div>
			</div><!-- End Of Left -->