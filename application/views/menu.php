<?php
	$uri = $_SERVER['PHP_SELF'];
	$uri = substr($uri, 11);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	<?php if($uri == "users/home") echo 'Главная страница';?>
	<?php if($uri == "users/news") echo 'Наши новинки';?>
	<?php if($uri == "users/feast") echo 'Праздничные блюда';?>
	<?php if($uri == "users/daily") echo 'Ежедневные вкусняшки';?>
	<?php if($uri == "users/master") echo 'Мастер-класс';?>
	<?php if($uri =~ "users/recipes/show/\d+") echo 'Описание рецепта';?>
</title>
<meta name="keywords" content="free design template, download web templates, Fruit And Juice Website, XHTML, CSS" />
<meta name="description" content="Fruit And Juice - Free CSS Template, Free XHTML CSS Design Layout" />
<link href="/templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>highslide/highslide.css" />
<script type="text/javascript" src="<?=base_url();?>highslide/highslide-with-gallery.js"></script>
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
		<div id="templatemo_header">
			<div id="templatemo_menu">
				<ul>
					<li><a href="<?=base_url();?>users/home" <?php if($uri == "users/home") echo 'class="current"';?>>Главная страница</a></li>
					<li><a href="<?=base_url();?>users/news" <?php if($uri == "users/news") echo 'class="current"';?>>Новые&nbsp;рецепты</a></li>
					<li><a href="<?=base_url();?>users/feast" <?php if($uri == "users/feast") echo 'class="current"';?>>На&nbsp;праздник</a></li>
					<li><a href="<?=base_url();?>users/daily" <?php if($uri == "users/daily") echo 'class="current"';?>>На&nbsp;каждый&nbsp;день</a></li>
					<li><a href="<?=base_url();?>users/forum" <?php if($uri == "users/forum") echo 'class="current"';?>>Форум</a></li>
					<li><a href="<?=base_url();?>users/master" <?php if($uri == "users/master") echo 'class="current"';?>>Мастер-класс</a></li>
				</ul>
			</div>
		</div>
		<div id="templatemo_content_area">	
			<div id="templatemo_left_col">
				<div class="templatemo_section">
					<h1>News &amp; Events</h1>
						<h2>24 / DEC / 2024</h2>
						<p>Pulvinar dui in ipsum cursus non interdum neque porta.</p>
						<h2>22 / DEC / 2024</h2>
						<p>Diam volutpat lobortis fau cibus, turpis mau ris faci lisis lorem.</p>
						<h2>26 / NOV / 2024</h2>
						<p>Sed blandit ipsum est vitae metus. Phasellus nisi erat.</p>
						<h2>18 / NOV / 2024</h2>
						<p>Morbi lobo rtis neque sed mau ris faci lisis phar etra int eger odio lacus.</p>
				</div>
				<div class="templatemo_section">
					<h1>W3C Validators</h1>
					<p>
						<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" width="88" height="31" border="0" /></a>
						<a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px" alt="Valid CSS" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" /></a>
					</p> 
				</div>
			</div><!-- End Of Left -->