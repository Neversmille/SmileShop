<div class="items">
<div class="container">
<div class="row">
<div class="col-md-12">
<h3 class="title">Горячие предложения</h3>
</div>
		<!-- Item #1 -->
		<?php foreach($products as $item):?>
		<div class="col-md-3 col-sm-4">
		<div class="item">
			<!-- Item image -->
			<div class="item-image">
			<a href="<?=base_url().'product/'.$item['product_url'];?>"><img src="/asset/upload/catalog/<?=$item['product_img'];?>" alt="" /></a>
			</div>
			<!-- Item details -->
			<div class="item-details">
			<!-- Name -->
			<!-- Use the span tag with the class "ico" and icon link (hot, sale, deal, new) -->
			<h5><a href="<?=base_url().'product/'.$item['product_url'];?>"><?=$item['product_name'];?></a><span class="ico"><img src="/asset/img/hot.png" alt="" /></span></h5>
			<div class="clearfix"></div>
			<!-- Para. Note more than 2 lines. -->
			<p><?=$item['product_description'];?></p>
			<hr />
			<!-- Price -->
			<div class="item-price pull-left"><?=$item['product_price'];?> грн</div>
			<!-- Add to cart -->
			<div class="button pull-right product-add-to-order">
			<input class="product-amount" type="hidden" value=1>
				<a class="itemsAdd product-add" href="javascript:void( 0 )" data-id="<?=$item['product_id'];?>">В корзину</a>
			</div>
			<div class="clearfix"></div>
			</div>
		</div>
		</div>
		<?php endforeach;?>

</div>
</div>
</div>
