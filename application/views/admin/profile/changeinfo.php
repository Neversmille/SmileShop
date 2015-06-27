<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Изменение пароля</div>
        </div>
		<div class="block-content collapse in">
		    <div class="span12">
		        <?=form_open('admin/profile/changeinfo',array("class" => "form-horizontal", "id" => "edit-profile"));?>
				<?=form_hidden('admin_id', $admin_info["admin_id"]);?>

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

				<div class="form-actions">
					<?=form_submit(array('name' => 'update_info',
										'class' => 'btn btn-primary',
										'value' => 'Изменить'));?>
                    </div>

				<?=form_close();?>

		    </div>
		</div>
	</div>
</div>
