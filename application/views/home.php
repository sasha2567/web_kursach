<?php 
	require_once 'menu.php';
?>

            <div id="templatemo_right_col">
                 
            	<div class="templatemo_post_area">
            		<h1>Рецепты</h1>
            	</div>

                <?php foreach ($recipes as $item):?>
					<li>
						<a href="/users/recipes/show/<?=$item['recipe_id']?>">
							<img src="<?=base_url();?>images/<?=$item['image']?>" />
						</a>
						&nbsp;
						<a href="/users/recipe/show/<?=$item['recipe_id']?>">
							<?=$item['description']?>
						</a>
						</li>
				<?php endforeach; ?>
            </div><!-- End Of Right -->
            <div class="cleaner"></div>
            
            <div id="templatemo_footer">Copyright © 2024 <a href="#">Your Company Name</a> | Designed by <a href="http://www.templatemo.com" target="_parent">Free CSS Templates</a></div>
            
            <div class="cleaner"></div>
        </div><!-- End Of Content Area -->    
    </div><!-- End Of Container -->
<!--  Free CSS Templates by TemplateMo.com  -->
</body>
</html>