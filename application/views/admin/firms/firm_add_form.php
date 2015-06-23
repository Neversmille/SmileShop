<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Добавление фирмы</div>
        </div>
		<div class="block-content collapse in">
		    <div class="span12">
		        <?=form_open('admin/firms/add',array("class" => "form-horizontal"));?>

				<div class="control-group">
  					<label class="control-label">Название:</label>
  						<div class="controls">
  							<?=form_input(array('name' => 'firm_name',
													'value' => set_value('firm_name'),
													'class' => 'span6 m-wrap'));?>
							<?=form_error("firm_name");?>
  						</div>
  				</div>

				<div class="form-actions">
					<?=form_submit(array('name' => 'add',
										'class' => 'btn btn-primary',
										'value' => 'Добавить'));?>
                    </div>

				<?=form_close();?>

		    </div>
		</div>
	</div>
</div>
