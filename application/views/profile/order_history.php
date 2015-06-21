<h5 class="title">История заказов</h5>
<div class="row orders">
	<?php if (empty($orders)|| empty($orders_history)):?>
		<div class="col-md-12">Вы не делали не одной покупки</div>
	<?php else:?>
		<?php foreach ($orders as $order): ?>
			<div class="col-md-12 order-info">
				<i class="fa fa-chevron-down"></i>
				<span class="order-id">№<?=$order["order_id"];?></span>
				<span class="order-amount"> товаров: <?=count($orders_history[$order["order_id"]]);?></span>
				<span class="order-cost">на <?=$order["order_price"];?> грн.</span>
				<span class="order-date">от <?=$order["order_create_date"];?></span>
				<?php if($order["order_complete"]==0)
				 			echo "<span class='order-status'>выполняется</span>";
						else  echo "<span class='order-status green'>выполнен</span>"; ?>
			</div>
			<div class="col-md-12 order-detail">
			<?php foreach ($orders_history[$order["order_id"]] as $value): ?>
				<div class="col-md-12 order-detail-item">
					<span class="col-md-2 order-detail-item-name"><a href="<?=base_url().'product/'.$value['product_url'];?>"><?=$value["product_name"];?></a></span>
					<span class="col-md-2 order-price"><?=$value["product_price"];?> грн.</span>
					<span class="col-md-2 order-detail-amount"><?=$value["orderItem_amount"];?> шт.</span>
					<span class="col-md-2 order-detail-price"><?=$value["product_price"]*$value["orderItem_amount"];?> грн.</span>
				</div>
			<?php endforeach; ?>
			</div>
		<?php endforeach;?>
	<?php endif;?>
</div>

</ul>
