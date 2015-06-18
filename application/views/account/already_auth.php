<p>Вы авторизированы как <a href="<?=base_url().'/myaccount';?>"><?=$user_info['client_name'];?></a></p>
<?php if ($continue_order):?>
	<div class="button continue-order">
		<a  href="<?=base_url().'order';?>" data-id="4">Продолжить оформление заказа</a>
	</div>
<?php endif;?>
<p>
	<a class="color" href="/catalog">Продолжить покупки</a> /
	<a href="/logout">Выйти</a>
</p>
