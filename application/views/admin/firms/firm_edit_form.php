<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Редактирование фирмы</div>
        </div>
		<div class="block-content collapse in">
			<?php if(isset($update)) echo "<div class='update green'>Данные фирмы обновлены!!</div>";?>
		    <div class="span12">
		        <?=form_open('admin/firm/'.$firm_info["firm_name"],array("class" => "form-horizontal","id" => "firm_edit"));?>
				<?=form_hidden('firm_id', $firm_info["firm_id"]);?>

				<div class="control-group">
  					<label class="control-label">Название:</label>
  						<div class="controls">
  							<?=form_input(array('name' => 'firm_name',
													'value' => $firm_info["firm_name"],
													'class' => 'span6 m-wrap'));?>
							<?=form_error("firm_name");?>
  						</div>
  				</div>

				<div class="form-actions">
					<?=form_submit(array('name' => 'update_firm',
										'class' => 'btn btn-primary',
										'value' => 'Сохранить'));?>
                    </div>

				<?=form_close();?>

		    </div>
		</div>
	</div>
</div>
