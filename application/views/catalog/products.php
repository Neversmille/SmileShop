<div class="items">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-3 hidden-xs">
				<h5 class="title">Фильтры</h5>
				<?=$firms;?>
				<br />
			  </div>

			  <div class="col-md-9 col-sm-9">

				<!-- Breadcrumb -->
				<ul class="breadcrumb" data-product=<?=$product;?>>
				  <li><a href="<?=base_url();?>">Главная</a></li>
				  <li><a href="<?=base_url().'catalog';?>">Каталог</a></li>
				  <li class="active category" data-category="<?=$category_id;?>"><a href="<?=base_url().'catalog/'.$category;?>"><?=$category_name;?></a></li>
				</ul>

				<!-- Title -->
				<h4 class="pull-left capitalize"><?=$product_firm;?></h4>

				<!-- Sorting -->
				<div class="form-group pull-right">
					<select data-order="<?=$order;?>" class="form-control catalog-order" onchange="window.location.href=$(this).val()">
						<option <?php if ($order=="new") echo ' selected ' ?>value="<?=$url_for_order.'order=new';?>">Новинки</option>
						<option <?php if ($order=="name") echo ' selected ' ?>value="<?=$url_for_order.'order=name';?>">По имени</option>
						<option <?php if ($order=="pricemin") echo ' selected ' ?>value="<?=$url_for_order.'order=pricemin';?>">От дешевых к дорогим</option>
						<option <?php if ($order=="pricemax") echo ' selected ' ?>value="<?=$url_for_order.'order=pricemax';?>">От дорогих к дешевому</option>
					</select>
				</div>

				<div class="clearfix"></div>

				<div class="row catalogItems">
					<?php if(empty($products)):?>
						<div class="col-md-4 col-sm-6">
							<h4>По вашему запросу товаров не найдено</h4>
						</div>
					<?php else:?>
						<!-- Item CODEIGNITER -->
						<?php foreach ($products as $value):?>
							<div class="col-md-4 col-sm-6">
								<!-- Each item should be enclosed in "item" class -->
								<div class="item">
									<!-- Item image -->
									<div class="item-image">
										<a href="<?=base_url().'product/'.$value['product_url'];?>"><img src="/asset/upload/catalog/<?=$value['product_img'];?>" alt="" class="img-responsive" /></a>
									</div>
									<!-- Item details -->
									<div class="item-details ">
										<!-- Name -->
										<!-- Use the span tag with the class "ico" and icon link (hot, sale, deal, new) -->
										<h5><a href="<?=base_url().'product/'.$value['product_url'];?>"><?=$value['product_name'];?></a>
											<?php if ($value['product_hot']):?>
												<span class="ico">
												<img src="/asset/img/hot.png" alt="" /></span>
											<?php endif;?>
										</h5>
										<div class="clearfix">
											<p class="color capitalize"><?php echo $value['product_firm'];?></p>
										</div>
										<!-- Para. Note more than 2 lines. -->
										<p><?php echo $value['product_description'];?></p>
										<hr />
										<!-- Price -->
										<div class="item-price pull-left"><?=$value['product_price'];?> грн</div>
										<!-- Add to cart -->
										<div class="button pull-right product-add-to-order">
											<input class="product-amount" type="hidden" value=1>
											<a class="itemsAdd product-add" href="javascript:void( 0 )" data-id="<?=$value['product_id'];?>">В корзину</a>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						<?php endforeach;?>
					<?php endif;?>
				</div>
				<div class="row">
					<div class="col-md-9 col-sm-9">
						<!-- Pagination -->
						<div class="paging">
							<?php echo $this->pagination->create_links(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
  	</div>
</div>
