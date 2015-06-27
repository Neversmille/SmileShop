<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Изменение пароля</div>
        </div>
		<div class="block-content collapse in">
		    <div class="span12">
		        <?=form_open('admin/profile/changepass',array("class" => "form-horizontal", "id" => "edit-pass"));?>
				<?=form_hidden('admin_id', $admin_id);?>

				<div class="control-group">
  					<label class="control-label">Текущий пароль:</label>
  						<div class="controls">
  							<?=form_input(array('name' => 'oldpass',
													'type' => 'password',
													'class' => 'span6 m-wrap'));?>
							<?=form_error("oldpass");?>
  						</div>
  				</div>

				<div class="control-group">
  					<label class="control-label">Новый пароль:</label>
  						<div class="controls">
  							<?=form_input(array('name' => 'newpass',
													'type' => 'password',
													'class' => 'span6 m-wrap'));?>
							<?=form_error("newpass");?>
  						</div>
  				</div>

				<div class="control-group">
  					<label class="control-label">Повторите пароль:</label>
  						<div class="controls">
  							<?=form_input(array('name' => 'confpass',
													'type' => 'password',
													'class' => 'span6 m-wrap'));?>
							<?=form_error("confpass");?>
  						</div>
  				</div>

				<div class="form-actions">
					<?=form_submit(array('name' => 'update_pass',
										'class' => 'btn btn-primary',
										'value' => 'Изменить'));?>
                    </div>

				<?=form_close();?>

		    </div>
		</div>
	</div>
</div>
