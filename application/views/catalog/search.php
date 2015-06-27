<div class="items">
	<div class="container">
		<div class="row">

			  <div class="col-md-12 col-sm-12">
                  <ul class="breadcrumb">
				<!-- Breadcrumb -->
				  <li><a href="<?=base_url();?>">Главная</a></li>
				  <li><a href="<?=base_url().'catalog';?>">Каталог</a></li>
				</ul>

				<!-- Title -->
				<div class="clearfix"><h4 class="pull-left capitalize">Поиск товара</h4></div>
                <div>

                                    <form role="form" id="search" method="POST" action="/catalog/find">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="Поиск по сайту...">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-default">Поиск</button>
                                            </span>
                                        </div>
                                    </form>
                </div>

				<div class="clearfix"></div>
                 <?php if(isset($products)):?>
				<div class="row catalogItems">
					<?php if(empty($products)):?>
						<div class="col-md-12 col-sm-12">
							<h4>По вашему запросу "<?=$search_text;?>" товаров не найдено, попробуйте уточнить ваш запрос</h4>
						</div>
					<?php else:?>
                        <div class="col-md-12 col-sm-12">
                            <h4>Результаты поиска по запросу "<?=$search_text;?>", совпадений по вашему запросу <?=$search_count;?> </h4>
                        </div>
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
											<p class="color capitalize"><?php echo $value['firm_name'];?></p>
										</div>
										<!-- Para. Note more than 2 lines. -->
										<p class="catalog-descr"><?php echo $value['product_description'];?></p>
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
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <!-- Pagination -->
                            <div class="paging">
                                <?php echo $this->pagination->create_links(); ?>
                            </div>
                        </div>
                    </div>
				</div>
                <?php endif;?>

			</div>
		</div>
  	</div>
</div>
