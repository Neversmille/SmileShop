<div class="form">
	<form class="form-horizontal" method="POST" action="/account/register" id="register">
		<div class="form-group">
			<label class="control-label col-md-3" for="name">Имя:</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="name" value="<?=set_value('name','');?>"><?=form_error("name");?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3" for="lastname">Фамилия:</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="lastname" value="<?=set_value('lastname','');?>"><?=form_error("lastname");?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3" for="email">eMail:</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="email" value="<?=set_value('email','');?>"><?=form_error("email");?><?php if(isset($mail_error)) echo $mail_error; ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3" for="password">Пароль:</label>
			<div class="col-md-7">
				<input type="password" class="form-control" name="password"><?=form_error("password");?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-9 col-md-offset-3">
			<button type="submit" class="btn btn-default" name="register">Зарегистрировать</button>
			<button type="reset" class="btn btn-default">Очистить</button>
			</div>
		</div>
	</form>
</div>
