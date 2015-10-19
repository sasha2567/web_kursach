<?php 
	require_once 'menu.php';
?>
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
<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10"
        alt="Valid XHTML 1.0 Transitional" width="88" height="31" border="0" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px" alt="Valid CSS"
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue" /></a>
        			</p> 
                </div>
            </div><!-- End Of Left -->
            
            <div id="templatemo_right_col">
                 
            	<div class="templatemo_post_area">
            		<h1>Рецепты</h1>
            	</div>

                <?php foreach ($recipes as $item):?>
					<li>
						<a href="/users/recipe/show/<?=$item['recipe_id']?>">
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