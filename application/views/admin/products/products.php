<?=$products_category_menu;?>
<div class="span9 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Каталог товаров<?php if(!empty($category_name)) echo ", категория - ".$category_name; ?></div>
        </div>
		<div class="block-content collapse in">
		    <div class="span12">
		        <div class="table-toolbar">
		            <div class="btn-group">
		                <a href="#"><button class="btn btn-success product_add">Добавить</button></a>
		            </div>
		        </div>
		        <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
					<div>
						<!-- <div class="span6">
							<div id="example2_length" class="dataTables_length">
								<label>
									<select size="1" name="example2_length" aria-controls="example2">
										<option value="10" selected="selected">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select> records per page
								</label>
							</div>
						</div>
						<div class="span6">
							<div class="dataTables_filter" id="example2_filter">
								<label>Поиск: <input type="text" aria-controls="example2"></label>
							</div>
						</div>
					</div> -->
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable" id="example2" aria-describedby="example2_info">
				        <thead>
				            <tr role="row">
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 157px;" aria-label="Rendering engine: activate to sort column ascending">Id</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 232px;" aria-label="Browser: activate to sort column ascending">Наименование</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 217px;" aria-label="Platform(s): activate to sort column ascending">Цена</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 133px;" aria-label="Engine version: activate to sort column ascending">Статус</th>
							</tr>
				        </thead>
				        <tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php if(empty($products)):?>
								<tr>
									Нет товаров
								</tr>
							<?php else:?>
								<?php foreach($products as $product):?>
									<tr class="gradeX odd">
						                    <td class=""><?=$product["product_id"];?></td>
						                    <td class=""><a href="/admin/product/<?=$product['product_url'];?>"><?=$product["product_name"];?></a></td>
						                    <td class=""><?=$product["product_price"];?> грн.	</td>
						                    <td class="center">
												<?php if($product["product_avaible"]==0):?>
													<span class="red">нет в наличии</span>
												<?php else:?>
													<span class="green">в наличи</span>
												<?php endif;?>
										</td>
									</tr>
								<?php endforeach;?>
							<?php endif;?>
						</tbody>
					</table>
					<div>
						<!-- <div class="span6">
							<div class="dataTables_info" id="example2_info">Showing 1 to 10 of 57 entries</div>
						</div> -->
						<div class="span6">

						</div>
					</div>
				</div>
		    </div>
		</div>
	</div>
</div>
</div>
