<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Редактирование слайда</div>
        </div>
		<div class="block-content collapse in">
		    <div class="span12">
		        <?=form_open_multipart('admin/slider/edit/'.$slide_info["slider_id"],array("class" => "form-horizontal", "id" => "slide_edit"));?>
				<?=form_hidden('slider_id',  $slide_info["slider_id"]);?>
				<div class="control-group">
					<label class="control-label">Позиция(1-99):</label>
						<div class="controls">
							<?=form_input(array('name' => 'slider_position',
													'value' => set_value('slider_position',$slide_info["slider_position"]),
													'class' => 'span1 m-wrap slider_position'));?>
							<?=form_error("slider_position");?>
						</div>
				</div>

				<div class="control-group">
					<label class="control-label">Статус:</label>
							<div class="controls">
								<?php
									$options = array("1" => "Отображаемый", "0" => "Скрытый");
									echo form_dropdown('slider_is_active', $options,$slide_info["slider_is_active"]);
								;?>
								<?=form_error("slider_is_active");?>
							</div>
				</div>

				<div class="control-group">
  					<label class="control-label">Наименование:</label>
  						<div class="controls">
  							<?=form_input(array('name' => 'slider_product_name',
													'value' => set_value('slider_product_name',$slide_info["slider_product_name"]),
													'class' => 'span6 m-wrap slider_product_name'));?>
							<?=form_error("slider_product_name");?>
  						</div>
  				</div>

				<div class="control-group">
					<label class="control-label">Описание:</label>
							<div class="controls">
								<?=form_textarea(array('name' => 'slider_description',
													'value' => set_value('slider_description',$slide_info["slider_description"]),
													'class' => 'span6 m-wrap slider_description'));?>
								<?=form_error('slider_description');?>
							</div>
				</div>

				<div class="control-group img-wrap">
					<label class="control-label">Изображение:</label>
					<div class="controls">
						<?=form_upload(array('name' => 'product_img',
													'class' => 'span6 m-wrap'));?>
						<?php if(isset($file_error)) echo $file_error;?>

					</div>
				</div>

				<?php if(!empty($slide_info["slider_image"])):?>
					<div class="control-group">
						<label class="control-label">Текущее изображение:</label>
						<div class="controls product_preview">
							<img src="/asset/upload/slider/<?=$slide_info["slider_image"];?>">
						</div>
					</div>
				<?php endif;?>

				<div class="form-actions">
					<?=form_submit(array('name' => 'slide_edit',
										'class' => 'btn btn-primary',
										'value' => 'Сохранить'));?>
                    </div>

				<?=form_close();?>

		    </div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="/asset/admin/js/slide_add_form.js"></script>
