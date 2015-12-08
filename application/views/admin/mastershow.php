<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
			<div id="templatemo_right_col">
				
				<?php
				if(isset($master)){
				?>
					<div id="container">
						<div id="body">
					
							<div class="master">
									<h1 id="headerform"><?php if($lang == 'rus') echo 'Тема'; else echo 'Subject';?>: <?=$master['master']['subject']?></h1>
								<p>
									<?php if($lang == 'rus') echo 'Описание'; else echo 'Description';?>: <?=$master['master']['description']?>
								</p>
							</div>
							<p>
								<?php if($lang == 'rus') echo 'Приглашенные пользователи'; else echo 'Follow users';?>
							</p>
							<table>
								<th>
									<td>
										Никнейм
									</td>
									<td>
										ФИО
									</td>
									<td>
										Удалить
									</td>	
								</th>
						<?php
							foreach ($master['users'] as $value) {
						?>
								<tr>
									<td>
										<?=$value['username']?>
									</td>
									<td>
										<?=$value['fio']?>
									</td>
									<td>
										<a href="<?=base_url();?>admin/admin_master/delete/<?=$value['user_id']?>/<?=$master['master']['master_id']?>">Удалить</a>
									</td>
								</tr>
						<?php
							}
						?>
							</table>
						</div>
					</div>
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