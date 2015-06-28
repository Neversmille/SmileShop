<?php if (!empty($recent_items)):?>
	<!-- Owl Carousel Starts -->
	<div class="container">
		<div class="rp">
			<!-- Recent News Starts -->
			<h4 class="title">Просмотренные товары <i class="fa fa-eye"></i></h4>
			<div class="recent-news block">
				<!-- Recent Item -->
				<div class="recent-item">
					<div class="custom-nav">
						<a class="prev"><i class="fa fa-chevron-left br-lblue"></i></a>
						<a class="next"><i class="fa fa-chevron-right br-lblue"></i></a>
					</div>
					<div id="owl-recent" class="owl-carousel">
						<?php foreach ($recent_items as $item):?>
							<!-- Item -->
							<div class="item clearfix">
								<a href="<?=base_url().'product/'.$item['product_url'];?>"><img src="/asset/upload/catalog/<?=$item["product_img"];?>" alt="" class="img-responsive" /></a>
								<!-- Heading -->
								<h4><a href="<?=base_url().'product/'.$item['product_url'];?>"><?=$item['product_name'];?></a></h4>
								<div class="clearfix"></div>
								<!-- Paragraph -->
								<p class="catalog-descr"><?=$item["product_description"];?></p>
								<div class="item-price pull-left"><?=$item["product_price"];?> грн.</div>
								<div class="button pull-right product-add-to-order">
									<input class="product-amount" type="hidden" value="1">
									<a class="itemsAdd product-add" href="javascript:void( 0 )" data-id="<?=$item['product_id'];?>">В корзину</a>
								</div>
							</div>

						<?php endforeach;?>

					</div>
				</div>
			</div>

			<!-- Recent News Ends -->
		</div>

	</div>
	<!-- Owl Carousel Ends -->
<?php endif;?>
