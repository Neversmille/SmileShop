<nav class="catalog-firms">
	<ul id="nav">
	<li class="has_sub"><a href="#">Производители</a>
	<ul style="display:block;">
		<?php if(!empty($firm_list)):?>
		<?php foreach ($firm_list as $value): ?>
			<li><a class="catalog-firms <?php if($value["firm_name"]==$product_firm)echo "active";?>" href="<?=base_url().'catalog/'.$category.'/firm='.$value['firm_name'];?>"><?=$value["firm_name"];?></a></li>
		<?php endforeach;?>
		<?php endif;?>
	</ul>
	</li>
</ul>
</nav>
