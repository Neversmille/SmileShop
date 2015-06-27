<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Полная информация о отзыве</div>
        </div>
		<div class="block-content collapse in">
			<?=form_open('admin/orders/edit/'.$order_info["order_id"],array("class" => "form-horizontal"));?>
				<?=form_hidden('order_id', $order_info["order_id"]);?>
				<div class="control-group">
					<label class="control-label">Статус:</label>
							<div class="controls">
								<?php
									$options = array("0" => "Новый", "1" => "Принят", "2" => "Выполнен", "3" => "Отменен");
									echo form_dropdown('order_status', $options,$order_info["order_complete"]);
								;?>
								<?=form_error("order_status");?>
							</div>
				</div>
				<div class="form-actions">
					<?=form_submit(array('name' => 'order_edit',
										'class' => 'btn btn-primary',
										'value' => 'Изменить'));?>
					</div>

			<?=form_close();?>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Cумма заказа:</label>
				<div class="controls col-md-8 checkoutLabel"><?=$order_info['order_price'];?> грн.</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Имя:</label>
				<div class="controls col-md-8 checkoutLabel"><?=$order_info['client_name'];?></div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Фамилия:</label>
				<div class="controls col-md-8 checkoutLabel"><?=$order_info['client_lastname'];?></div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Телефон:</label>
				<div class="controls col-md-8 checkoutLabel"><?=$order_info['order_phone'];?> </div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Доп. информация:</label>
				<div class="controls col-md-8 checkoutLabel"><?php if(empty($order_info['order_text'])) echo "Нет доп. информации"; else echo $order_info['order_text'];?> </div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Дата заказа:</label>
				<div class="controls col-md-8 checkoutLabel"><?=$order_info['order_create_date'];?> </div>
			</div>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable" id="example2" aria-describedby="example2_info">
				<thead>
					<tr role="row">
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 157px;" aria-label="Rendering engine: activate to sort column ascending">Id</th>
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 232px;" aria-label="Browser: activate to sort column ascending">Наименование</th>
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 232px;" aria-label="Browser: activate to sort column ascending">Изображение</th>
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 232px;" aria-label="Browser: activate to sort column ascending">Кол-во</th>
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 232px;" aria-label="Browser: activate to sort column ascending">Цена</th>
						<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 232px;" aria-label="Browser: activate to sort column ascending">Наличие на складе</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php if(empty($order_products)):?>
						<tr>
							<td>Нет фирм</td>
						</tr>
					<?php else:?>
						<?php foreach($order_products as $product):?>
							<tr class="gradeX odd">
									<td class=""><?=$product["orderItem_product_id"];?></td>
									<td class=""><a href="/admin/product/<?=$product['product_url'];?>"><?=$product['product_name'];?></a></td>
									<td><img src="/asset/upload/catalog/<?=$product['product_img'];?>"></td>
									<td><?=$product['orderItem_amount'];?></td>
									<td><?=$product['orderItem_price'];?></td>
									<td><?php if($product['product_avaible']==0) echo "<span class='red'>Нет в наличии</span>"; else echo "<span class='green'>В наличии</span>";?></td>
							</tr>
						<?php endforeach;?>
					<?php endif;?>
				</tbody>
			</table>
		    </div>
		</div>
	</div>
</div>
