<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="/admin">Админ панель</a>
			<div class="nav-collapse collapse">

				<?=$admin_widget;?>

				<ul class="nav">
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle">Товары <b class="caret"></b></a>
						<ul class="dropdown-menu" id="menu1">
							<li>
								<a href="/admin/products">Каталог товаров</a>
							</li>
							<li>
								<a href="/admin/firms">Фирмы</a>
							</li>
						</ul>
					</li>
					<li>
                            <a tabindex="-1" href="/admin/orders">Заказы</a>
                        </li>
					<li>
	                        <a tabindex="-1" href="/admin/reviews">Отзывы</a>
	                    </li>
					<li>
						<a href="/admin/slider">Слайдер</a>
					</li>
					<li>
						<a href="/admin/admins">Администраторы</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
