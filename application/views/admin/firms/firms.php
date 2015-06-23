<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Каталог товаров<?php if(!empty($category_name)) echo ", категория - ".$category_name; ?></div>
        </div>
		<div class="block-content collapse in">
		    <div class="span12">
		        <div class="table-toolbar">
		            <div class="btn-group">
		                <a href="/admin/firms/add"><button class="btn btn-success product_add">Добавить</button></a>
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
							</tr>
				        </thead>
				        <tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php if(empty($firms)):?>
								<tr>
									Нет товаров
								</tr>
							<?php else:?>
								<?php foreach($firms as $firm):?>
									<tr class="gradeX odd">
						                    <td class=""><?=$firm["firm_id"];?></td>
						                    <td class=""><a href="/admin/firm/<?=$firm['firm_name'];?>"><?=$firm["firm_name"];?></a></td>
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
								<div class="span6">
									<div class="dataTables_paginate paging_bootstrap pagination">
										<?=$this->pagination->create_links(); ?>
									</div>
								</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</div>
</div>
</div>
