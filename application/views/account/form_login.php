<div class="form">
	<form class="form-horizontal" method="POST" action="/account/login">
		<div class="form-group">
			<label class="control-label col-md-3" for="email">eMail:</label>
			<div class="col-md-8">
				<input type="text" class="form-control" id="email" name="email" value="<?=set_value('email');?>"><?=form_error("email");?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3" for="password">Пароль:</label>
			<div class="controls col-md-8">
				<input type="password" class="form-control" id="password" name="password"><?=form_error("password");?>
				<?php if (isset($auth_error)) echo $auth_error;?>
			</div>
		</div>

		<!-- Buttons -->
		<div class="form-group">
			<!-- Buttons -->
			<div class="col-md-8 col-md-offset-3">
				<button type="submit" class="btn btn-danger" name="login">Войти</button>
				<button type="reset" class="btn btn-default">Очистить</button>
			</div>
		</div>
	</form>
	<hr />
	<h5>Новая учетная запись</h5>
	У Вас нет учетной записи?<a href="/register"> Зарегистрироваться</a>
</div>
