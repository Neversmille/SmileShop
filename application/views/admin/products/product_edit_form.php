<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">Редактирование товара</div>
        </div>
		<div class="block-content collapse in">
		    <div class="span12">
		        <?=form_open_multipart('admin/product/'.$product_info["product_url"],array("class" => "form-horizontal", "id" => "product_edit"));?>
				<?=form_hidden('product_id', $product_info["product_id"]);?>

				<div class="control-group">
  					<label class="control-label">Наименование:</label>
  						<div class="controls">
  							<?=form_input(array('name' => 'product_name',
													'value' => $product_info["product_name"],
													'class' => 'span6 m-wrap'));?>
							<?=form_error("product_name");?>
  						</div>
  				</div>

				<div class="control-group">
					<label class="control-label">URL:</label>
							<div class="controls">
								<?=form_input(array('name' => 'product_url',
													'value' => $product_info["product_url"],
													'class' => 'span6 m-wrap'));?>
								<?=form_error("product_url");?>
							</div>
				</div>

				<div class="control-group">
					<label class="control-label">Цена:</label>
							<div class="controls">
								<?=form_input(array('name' => 'product_price',
													'value' => $product_info["product_price"],
													'class' => 'span6 m-wrap'));?>
								<?=form_error("product_price");?>
							</div>
				</div>

				<div class="control-group">
					<label class="control-label">Изображение:</label>
					<div class="controls">
						<?=form_upload(array('name' => 'product_img',
													'class' => 'span6 m-wrap'));?>
						<?php if(isset($file_error)) echo $file_error;?>
					</div>
				</div>

				<?php if(!empty($product_info['product_img']) && !is_null($product_info['product_img'])):?>
					<div class="control-group">
						<label class="control-label">Текущее изображение:</label>
						<div class="controls product_preview">
							<img src="/asset/upload/catalog/<?=$product_info['product_img'];?>">
						</div>
					</div>
				<?php endif;?>

				<div class="control-group">
					<label class="control-label">Описание:</label>
							<div class="controls">
								<?=form_textarea(array('name' => 'product_description',
													'value' => $product_info["product_description"],
													'class' => 'span6 m-wrap'));?>
								<?=form_error("product_description");?>
							</div>
				</div>

				<div class="control-group">
					<label class="control-label">Категория:</label>
							<div class="controls">
								<?php
									foreach ($products_category as $category){
										$option_category[$category["category_id"]] = $category["category_name"];
									}
									echo form_dropdown('product_category_id', $option_category, $product_info["category_id"]);
								;?>
								<?=form_error("product_category_id");?>
							</div>
				</div>

				<div class="control-group">
					<label class="control-label">Фирма:</label>
							<div class="controls">
								<?php
									foreach ($products_firm as $firm){
										$option_firm[$firm["firm_id"]] = $firm["firm_name"];
									}
									echo form_dropdown('product_firm_id', $option_firm, $product_info["firm_id"]);
								;?>
								<?=form_error("product_firm_id");?>
							</div>
				</div>

				<div class="control-group">
					<label class="control-label">Горячее предложение:</label>
							<div class="controls">
								<?php
									$option_hot = array("0" => "Нет", "1" => "Да");
									echo form_dropdown('product_hot', $option_hot, $product_info["product_hot"]);
								;?>
								<?=form_error("product_hot");?>
							</div>
				</div>

				<div class="control-group">
					<label class="control-label">Наличие на складе:</label>
							<div class="controls">
								<?php
									$option_avaible = array("0" => "Нет в наличии", "1" => "Есть в наличии");
									echo form_dropdown('product_avaible', $option_avaible, $product_info["product_avaible"]);
								;?>
								<?=form_error("product_avaible");?>
							</div>
				</div>


				<div class="form-actions">
					<?=form_submit(array('name' => 'update_product',
										'class' => 'btn btn-primary',
										'value' => 'Изменить'));?>
                    </div>

				<?=form_close();?>

		    </div>
		</div>
	</div>
</div>
