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
					<p>
						Приглашенные пользователи
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
					foreach ($users as $value) {
				?>
						<tr>
							<td>
								<?=$value['username']?>
							</td>
							<td>
								<?=$value['fio']?>
							</td>
							<td>
								<a href="<?=base_url();?>admin/master/delete/<?=$value['user_id']?>">Удалить</a>
							</td>
						</tr>
				<?php
					}
				?>
					</table>
				<?php
				}
				else{
				?>
					<h3>
						Форма добавления мастер-класса
					</h3>
				<?php
				}
				?>