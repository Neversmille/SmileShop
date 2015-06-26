<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Изменение пароля</div>
        </div>
		<div class="block-content collapse in">
		    <div class="span12">
		        <?=form_open('admin/admins/add',array("class" => "form-horizontal"));?>

				<div class="control-group">
						<label class="control-label">Имя:</label>
							<div class="controls">
								<?=form_input(array('name' => 'name',
													'type' => 'text',
													'value' => set_value('name'),
													'class' => 'span6 m-wrap'));?>
							<?=form_error("name");?>
							</div>
					</div>

				<div class="control-group">
						<label class="control-label">eMail:</label>
							<div class="controls">
								<?=form_input(array('name' => 'email',
													'type' => 'text',
													'value' => set_value('email'),
													'class' => 'span6 m-wrap'));?>
							<?=form_error("email");?>
							</div>
					</div>

					<div class="control-group">
							<label class="control-label">Пароль:</label>
								<div class="controls">
									<?=form_input(array('name' => 'password',
														'type' => 'text',
														'class' => 'span6 m-wrap'));?>
								<?=form_error("password");?>
								</div>
						</div>

						<div class="control-group">
								<label class="control-label">Повторите пароль:</label>
									<div class="controls">
										<?=form_input(array('name' => 'confpass',
															'type' => 'text',
															'class' => 'span6 m-wrap'));?>
									<?=form_error("confpass");?>
									</div>
							</div>

							<div class="controul-group">
								<label for=""></label>
								<div class="controls">
									<h4>Привелегии:</h4>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Заказы:</label>
										<div class="controls">
											<?php
												$option_hot = array("0" => "Запрещено", "1" => "Разрешено");
												echo form_dropdown('allow_orders', $option_hot, "0");
											;?>
											<?=form_error("allow_orders");?>
										</div>
							</div>

							<div class="control-group">
								<label class="control-label">Товары:</label>
										<div class="controls">
											<?php
												$option_hot = array("0" => "Запрещено", "1" => "Разрешено");
												echo form_dropdown('allow_products', $option_hot, "0");
											;?>
											<?=form_error("allow_products");?>
										</div>
							</div>

							<div class="control-group">
								<label class="control-label">Фирмы:</label>
										<div class="controls">
											<?php
												$option_hot = array("0" => "Запрещено", "1" => "Разрешено");
												echo form_dropdown('allow_firms', $option_hot, "0");
											;?>
											<?=form_error("allow_firms");?>
										</div>
							</div>

							<div class="control-group">
								<label class="control-label">Комментарии:</label>
										<div class="controls">
											<?php
												$option_hot = array("0" => "Запрещено", "1" => "Разрешено");
												echo form_dropdown('allow_reviews', $option_hot, "0");
											;?>
											<?=form_error("allow_reviews");?>
										</div>
							</div>

							<div class="control-group">
								<label class="control-label">Слайдер:</label>
										<div class="controls">
											<?php
												$option_hot = array("0" => "Запрещено", "1" => "Разрешено");
												echo form_dropdown('allow_slider', $option_hot, "0");
											;?>
											<?=form_error("allow_slider");?>
										</div>
							</div>

							<div class="control-group">
								<label class="control-label">Администрирование:</label>
										<div class="controls">
											<?php
												$option_hot = array("0" => "Запрещено", "1" => "Разрешено");
												echo form_dropdown('allow_admins', $option_hot, "0");
											;?>
											<?=form_error("allow_admins");?>
										</div>
							</div>



				<div class="form-actions">
					<?=form_submit(array('name' => 'add_new_admin',
										'class' => 'btn btn-primary',
										'value' => 'Добавить'));?>
                    </div>

				<?=form_close();?>

		    </div>
		</div>
	</div>
</div>
