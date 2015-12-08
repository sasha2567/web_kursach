<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
			<div id="templatemo_right_col">
				
				<?php
				if(isset($masters)){
					foreach ($masters as $value) {
				?>
					<div id="container">
						<div id="body">
					
							<div class="master">
								<a id="masterdel" href="<?=base_url();?>admin/admin_master/deletemaster/<?=$value['master_id']?>">
									<?php if($lang == 'rus') echo 'Проведен'; else echo 'Performed';?>
								</a>
								<h1 id="headerform"><?php if($lang == 'rus') echo 'Тема:'; else echo 'Subject:';?>
									<a href="<?=base_url();?>admin/admin_master/show/<?=$value['master_id']?>">
										<?=$value['subject']?>
									</a>
								</h1>
							</div>
						</div>
					</div>
				<?php
					}
				}
				?>
				<script type="text/javascript">
					function validete () {
						var string = $('dateprovide').value();
						var t = /\d\d\d\d-\d\d\-\d\d\s\d\d:\d\d:\d\d/;
						var result = t.exec(string);
						if(result)
							return true;
						return false;
					}
				</script>
				<div id="container">
					<div id="body">
						<h1 id="headerform"><?php if($lang == 'rus') echo 'Добавить мастер-класс'; else echo 'Add master-class';?></h1>
					<?php
						if(isset($username) && $username !== FALSE){
							$attributes = array(
							    'class' => 'admin_master', 
							    'id' => 'form_master_add'
							);
							echo form_open('admin/admin_master/add', $attributes); 
					?>
							<h3><?php if($lang == 'rus') echo 'Тема'; else echo 'Subject';?></h3>
							<input type="text" name="subject" />
							<h3><?php if($lang == 'rus') echo 'Описание'; else echo 'Description';?></h3>
							<input type="text" name="description" />
							<h3><?php if($lang == 'rus') echo 'Дата проведения'; else echo 'Date provide';?></h3>
							<input type="text" name="dateprovide" />
							<div id="submit">
								<input type="submit" onclick="validate()" name="admin_master_btn" value="<?php if($lang == 'rus') echo 'Добавить'; else echo 'Add';?>" />
							</div>
					<?php
							echo form_close();
							echo validation_errors();
						}
					?>
					</div>
				</div>

				