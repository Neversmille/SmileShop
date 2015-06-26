<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Изменение данных администратора</div>
        </div>
		<div class="block-content collapse in">
		    <div class="span12">
		        <?=form_open('/admin/admins/editinfo/'.$admin_id,array("class" => "form-horizontal"));?>
				<?=form_hidden('admin_id', $admin_id);?>
				<div class="control-group">
						<label class="control-label">Имя:</label>
							<div class="controls">
								<?=form_input(array('name' => 'name',
													'type' => 'text',
													'value' => $admin_info["admin_name"],
													'class' => 'span6 m-wrap'));?>
							<?=form_error("name");?>
							</div>
					</div>

				<div class="control-group">
						<label class="control-label">eMail:</label>
							<div class="controls">
								<?=form_input(array('name' => 'email',
													'type' => 'text',
													'value' =>  $admin_info["admin_email"],
													'class' => 'span6 m-wrap'));?>
							<?=form_error("email");?>
							</div>
					</div>

					<div class="control-group">
						<label class="control-label">Статус:</label>
								<div class="controls">
									<?php
										$option_hot = array("0" => "Блокирован", "1" => "Активен");
										echo form_dropdown('is_active', $option_hot, $admin_info["admin_is_active"]);
									;?>
									<?=form_error("is_active");?>
								</div>
					</div>

				<div class="form-actions">
					<?=form_submit(array('name' => 'edit_admin',
										'class' => 'btn btn-primary',
										'value' => 'Редактировать'));?>
                    </div>

				<?=form_close();?>

		    </div>
		</div>
	</div>
</div>
