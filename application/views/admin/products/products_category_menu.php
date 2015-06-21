<div class="span3" id="sidebar">
    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
		<?php if(empty($products_category)):?>
			<li>
                <a href="#">Нет категорий</a>
            	</li>
		<?php else:?>
			<?php foreach($products_category as $value):?>
	            <li <?php if($value['category_alias']==$category) echo 'class="active"';?>>
	                <a class="capitalize" href="/admin/products/<?=$value['category_alias'];?>" data-id="<?=$value['category_id'];?>"><?=$value["category_name"];?></a>
	            </li>
			<?php endforeach;?>
		<?php endif;?>
	</ul>
</div>
