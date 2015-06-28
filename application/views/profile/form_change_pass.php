<h5 class="title">Изменить пароль</h5>
<div class="form">
	<form class="form-horizontal" method="POST" action="/profile/security" id="edit-profile-pass">
		<div class="form-group">
			<label class="control-label col-md-3" for="oldpass">Старый пароль:</label>
			<div class="col-md-7">
				<input type="password" class="form-control" name="oldpass" value="<?=set_value('oldpass','');?>"><?=form_error("oldpass");?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3" for="newpass">Новый пароль:</label>
			<div class="col-md-7">
				<input type="password" class="form-control" name="newpass" value="<?=set_value('newpass','');?>"><?=form_error("newpass");?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3" for="confpass">Повторите пароль:</label>
			<div class="col-md-7">
				<input type="password" class="form-control" name="confpass" value="<?=set_value('confpass','');?>"><?=form_error("confpass");?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-9 col-md-offset-3">
				<button type="submit" class="btn btn-default" name="changepass">Обновить</button>
				<button type="reset" class="btn btn-default">Очистить</button>
			</div>
		</div>
	</form>
</div>
<?php if(isset($changepass)):?>
	<div class="col-md-9 col-md-offset-3">
		<h4 class="green">пароль успешно изменен</h4>
	</div>
<?php endif;?>
