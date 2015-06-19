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
						<div class="item">
							<a href="#"><img src="/asset/upload/catalog/<?=$item["product_img"];?>" alt="" class="img-responsive" /></a>
							<!-- Heading -->
							<h4><a href="<?=base_url().'product/'.$item['product_url'];?>"><?=$item['product_name'];?><span class="pull-right"><?=$item["product_price"];?> грн.</span></a></h4>
							<div class="clearfix"></div>
							<!-- Paragraph -->
							<p><?=$item["product_description"];?></p>
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
