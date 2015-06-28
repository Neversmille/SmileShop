<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Редактирование товара</div>
        </div>
		<div class="block-content collapse in">
			<?php if(isset($add)) echo "<div class='update green'>Товар добавлен!!</div>";?>
		    <div class="span12">
				<div class="parse-wrap">
					<div class="btn-group control-left">
						<a href="javascript:void(0)" class="parse-link"><button class="btn btn-success product_add">Спарсить c price.ua</button></a>
					</div>
				</div>

		        <?=form_open_multipart('admin/products/add',array("class" => "form-horizontal","id" => "product_add"));?>

				<div class="control-group">
  					<label class="control-label">Наименование:</label>
  						<div class="controls">
  							<?=form_input(array('name' => 'product_name',
													'value' => set_value('product_name'),
													'class' => 'span6 m-wrap product_name'));?>
							<?=form_error("product_name");?>
  						</div>
  				</div>

				<div class="control-group">
					<label class="control-label">URL:</label>
							<div class="controls">
								<?=form_input(array('name' => 'product_url',
													'value' => set_value('product_url'),
													'class' => 'span6 m-wrap product_url'));?>
								<?=form_error("product_url");?>
							</div>
				</div>

				<div class="control-group">
					<label class="control-label">Цена:</label>
							<div class="controls">
								<?=form_input(array('name' => 'product_price',
													'value' => set_value('product_price'),
													'class' => 'span6 m-wrap product_price'));?>
								<?=form_error("product_price");?>
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

				<div class="control-group">
					<label class="control-label">Описание:</label>
							<div class="controls">
								<?=form_textarea(array('name' => 'product_description',
													'value' => set_value('product_description'),
													'class' => 'span6 m-wrap product_description'));?>
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
									echo form_dropdown('product_category_id', $option_category);
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
									echo form_dropdown('product_firm_id', $option_firm);
								;?>
								<?=form_error("product_firm_id");?>
							</div>
				</div>

				<div class="control-group">
					<label class="control-label">Горячее предложение:</label>
							<div class="controls">
								<?php
									$option_hot = array("0" => "Нет", "1" => "Да");
									echo form_dropdown('product_hot', $option_hot);
								;?>
								<?=form_error("product_hot");?>
							</div>
				</div>

				<div class="control-group">
					<label class="control-label">Наличие на складе:</label>
							<div class="controls">
								<?php
									$option_avaible = array("0" => "Нет в наличии", "1" => "Есть в наличии");
									echo form_dropdown('product_avaible', $option_avaible);
								;?>
								<?=form_error("product_avaible");?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="/asset/admin/js/add_form.js"></script>
