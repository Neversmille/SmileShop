<div class="hlinks">
            <span>
                    <!-- item details with price -->
                    <a href="<?=base_url().'basket';?>" role="button" data-toggle="modal">
                            Товаров: <span class="basket-item-count"><?=$basket_count;?></span> <i class="fa fa-shopping-cart"></i>
                    </a>
                </span>
        </div>
        <br>
        <?php if(($login_status)):?>
			<div class="hlinks">
	            <span>Здравствуйте <a href="/myaccount" style="border-bottom: 1px dotted #fff;"><?=$user_info["client_name"];?></a></span>
	            <span class="lr"><a href="/logout">Выйти</a></span>
			</div>
        <?php else:?>
			<div class="hlinks">
			<!-- Login and Register link -->
				<!-- <span class="lr"><a href="#login" role="button" data-toggle="modal">Login</a>
				or <a href="#register" role="button" data-toggle="modal">Register</a> -->
                <span class="lr"><a href="<?=base_url().'login'?>" role="button" data-toggle="modal">Авторизация</a>
                 / <a href="<?=base_url().'register'?>" role="button" data-toggle="modal">Регистрация</a>
				</span>
				<span class="lr vk"> <a href="https://oauth.vk.com/authorize?client_id=4937786&scope=email&redirect_uri=<?=base_url();?>account/vk&response_type=code">VK</a></span>
			</div>

        <?php endif;?>
