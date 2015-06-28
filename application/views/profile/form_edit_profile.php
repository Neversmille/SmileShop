<h5 class="title">Персональные данные</h5>
<div class="form">
	<form class="form-horizontal" method="POST" action="/profile" id="edit-profile">
		<div class="form-group">
			<label class="control-label col-md-3" for="name">Имя:</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="name" value="<?=set_value('name',$client_info['client_name']);?>"><?=form_error("name");?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3" for="lastname">Фамилия:</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="lastname" value="<?=set_value('lastname',$client_info['client_lastname']);?>"><?=form_error("lastname");?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">eMail</label>
			<div class="col-md-7">
				<p class="form-control-static"><?=$client_info["client_email"];?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-9 col-md-offset-3">
				<button type="submit" class="btn btn-default" name="register">Обновить</button>
				<button type="reset" class="btn btn-default">Очистить</button>
			</div>
		</div>
	</form>
</div>
