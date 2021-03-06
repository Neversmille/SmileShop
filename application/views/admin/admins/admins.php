<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Администраторы системы</div>
        </div>
		<div class="block-content collapse in">
		    <div class="span12">
		        <div class="table-toolbar">
		            <div class="btn-group">
		                <a href="/admin/admins/add"><button class="btn btn-success product_add">Добавить</button></a>
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
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 232px;" aria-label="Browser: activate to sort column ascending">Имя</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 232px;" aria-label="Browser: activate to sort column ascending">e-mail</th>
								<th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 232px;" aria-label="Browser: activate to sort column ascending">Действие</th>
							</tr>
				        </thead>
				        <tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php if(empty($admins)):?>
								<tr>
									Нет админов
								</tr>
							<?php else:?>
								<?php foreach($admins as $admin):?>
									<tr class="gradeX odd">
						                    <td class=""><?=$admin["admin_id"];?></td>
						                    <td class=""><?=$admin["admin_name"];?></td>
										<td class=""><?=$admin["admin_email"];?></td>
										<td class=""><a href="/admin/admins/editinfo/<?=$admin["admin_id"];?>">Изменить данные </a>/<a href="/admin/admins/editpass/<?=$admin["admin_id"];?>"> Изменить пароль</a></td>
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
