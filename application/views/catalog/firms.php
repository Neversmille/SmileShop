<nav>
	<ul id="nav">
	<!-- Main menu. Use the class "has_sub" to "li" tag if it has submenu. -->
	<li class="has_sub"><a href="#">Производители</a>
	<!-- Submenu -->
	<ul style="display:block;">

		<?php foreach ($firm_list as $value): ?>
			<li><a class="catalog-firms" href="<?=base_url().'catalog/'.$category.'/firm='.$value['product_firm'];?>"><?=$value["product_firm"];?></a></li>
		<?php endforeach;?>
	</ul>
	</li>

</ul>
</nav>
