<!-- Items -->
	<div class="items">
		<div class="container">
			<div class="row">
			<!-- Sidebar -->
			<div class="col-md-3 col-sm-3 hidden-xs">
				<h5 class="title">Фильтры</h5>
				<!-- Sidebar navigation -->
				<?=$firms;?>
				<br />
				<!-- Sidebar items (featured items)-->
				<div class="sidebar-items">
					<h5 class="title">Featured Items</h5>
					<!-- Item #1 -->
					<div class="sitem">
					  <!-- Don't forget the class "onethree-left" and "onethree-right" -->
					  <div class="onethree-left">
						<!-- Image -->
						<a href="single-item.php"><img src="/asset/img/photos/2.png" alt="" class="img-responsive" /></a>
					  </div>
					  <div class="onethree-right">
						<!-- Title -->
						<a href="single-item.php">HTC One V</a>
						<!-- Para -->
						<p>Aenean ullamcorper justo tincidunt justo aliquet.</p>
						<!-- Price -->
						<p class="bold">$199</p>
					  </div>
					  <div class="clearfix"></div>
					</div>

					<div class="sitem">
					  <div class="onethree-left">
						<a href="single-item.php"><img src="/asset/img/photos/3.png" alt="" class="img-responsive" /></a>
					  </div>
					  <div class="onethree-right">
						<a href="single-item.php">Sony One V</a>
						<p>Aenean ullamcorper justo tincidunt justo aliquet.</p>
						<p class="bold">$399</p>
					  </div>
					  <div class="clearfix"></div>
					</div>

					<div class="sitem">
					  <div class="onethree-left">
						<a href="single-item.php"><img src="/asset/img/photos/4.png" alt="" class="img-responsive" /></a>
					  </div>
					  <div class="onethree-right">
						<a href="single-item.php">Nokia One V</a>
						<p>Aenean ullamcorper justo tincidunt justo aliquet.</p>
						<p class="bold">$159</p>
					  </div>
					  <div class="clearfix"></div>
					</div>

					<div class="sitem">
					  <div class="onethree-left">
						<a href="single-item.php"><img src="/asset/img/photos/5.png" alt="" class="img-responsive" /></a>
					  </div>
					  <div class="onethree-right">
						<a href="single-item.php">Samsung One V</a>
						<p>Aenean ullamcorper justo tincidunt justo aliquet.</p>
						<p class="bold">$299</p>
					  </div>
					  <div class="clearfix"></div>
					</div>

				  </div>

			  </div>


		<!-- Main content -->
			  <div class="col-md-9 col-sm-9">

				<!-- Breadcrumb -->
				<ul class="breadcrumb">
				  <li><a href="<?=base_url();?>">Главная</a></li>
				  <li><a href="<?=base_url().'catalog';?>">Каталог</a></li>
				  <li class="active"><a href="<?=base_url().'catalog/'.$category;?>"><?=$category_name;?></a></li>
				</ul>

									<!-- Title -->
									  <h4 class="pull-left capitalize"><?=$product_firm;?></h4>

												  <!-- Sorting -->
													<div class="form-group pull-right">
														<select class="form-control" onchange="window.location.href=$(this).val()">
															<option>Сортировать</option>
															<option value="<?=$url_for_order.'order=new';?>">Новинки</option>
															<option value="<?=$url_for_order.'order=name';?>">По имени</option>
															<option value="<?=$url_for_order.'order=pricemin';?>">От дешевых к дорогим</option>
															<option value="<?=$url_for_order.'order=pricemax';?>">От дорогих к дешевому</option>
														</select>
													</div>

								  <div class="clearfix"></div>

					  <div class="row">

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

		<!-- Owl Carousel Starts -->
		<div class="container">

			<div class="rp">
				<!-- Recent News Starts -->
				<h4 class="title">Recent Items</h4>
				<div class="recent-news block">
						<!-- Recent Item -->
						<div class="recent-item">
							<div class="custom-nav">
								<a class="prev"><i class="fa fa-chevron-left br-lblue"></i></a>
								<a class="next"><i class="fa fa-chevron-right br-lblue"></i></a>
							</div>
							<div id="owl-recent" class="owl-carousel">
								<!-- Item -->
								<div class="item">
									<a href="#"><img src="/asset/img/photos/4.png" alt="" class="img-responsive" /></a>
									<!-- Heading -->
									<h4><a href="#">Sony Xperia <span class="pull-right">$105</span></a></h4>
									<div class="clearfix"></div>
									<!-- Paragraph -->
									<p>Nunc adipiscing, metus sollic itun molestie, urna augue dap ibus dui.</p>
								</div>
								<div class="item">
									<a href="#"><img src="/asset/img/photos/2.png" alt="" class="img-responsive" /></a>
									<!-- Heading -->
									<h4><a href="#">Applie iPhone <span class="pull-right">$210</span></a></h4>
									<div class="clearfix"></div>
									<!-- Paragraph -->
									<p>Nunc adipiscing, metus sollic itun molestie, urna augue dap ibus dui.</p>
								</div>
								<div class="item">
									<a href="#"><img src="/asset/img/photos/3.png" alt="" class="img-responsive" /></a>
									<!-- Heading -->
									<h4><a href="#">Google Nexus<span class="pull-right">$310</span></a></h4>
									<div class="clearfix"></div>
									<!-- Paragraph -->
									<p>Nunc adipiscing, metus sollic itun molestie, urna augue dap ibus dui.</p>
								</div>
								<div class="item">
									<a href="#"><img src="/asset/img/photos/4.png" alt="" class="img-responsive" /></a>
									<!-- Heading -->
									<h4><a href="#">Sony Xperai <span class="pull-right">$10</span></a></h4>
									<div class="clearfix"></div>
									<!-- Paragraph -->
									<p>Nunc adipiscing, metus sollic itun molestie, urna augue dap ibus dui.</p>
								</div>
								<div class="item">
									<a href="#"><img src="/asset/img/photos/2.png" alt="" class="img-responsive" /></a>
									<!-- Heading -->
									<h4><a href="#">Sony Xperai <span class="pull-right">$10</span></a></h4>
									<div class="clearfix"></div>
									<!-- Paragraph -->
									<p>Nunc adipiscing, metus sollic itun molestie, urna augue dap ibus dui.</p>
								</div>
								<div class="item">
									<a href="#"><img src="/asset/img/photos/3.png" alt="" class="img-responsive" /></a>
									<!-- Heading -->
									<h4><a href="#">Sony Xperai <span class="pull-right">$10</span></a></h4>
									<div class="clearfix"></div>
									<!-- Paragraph -->
									<p>Nunc adipiscing, metus sollic itun molestie, urna augue dap ibus dui.</p>
								</div>
								<div class="item">
									<a href="#"><img src="/asset/img/photos/4.png" alt="" class="img-responsive" /></a>
									<!-- Heading -->
									<h4><a href="#">Sony Xperai <span class="pull-right">$10</span></a></h4>
									<div class="clearfix"></div>
									<!-- Paragraph -->
									<p>Nunc adipiscing, metus sollic itun molestie, urna augue dap ibus dui.</p>
								</div>
								<div class="item">
									<a href="#"><img src="/asset/img/photos/2.png" alt="" class="img-responsive" /></a>
									<!-- Heading -->
									<h4><a href="#">Sony Xperai <span class="pull-right">$10</span></a></h4>
									<div class="clearfix"></div>
									<!-- Paragraph -->
									<p>Nunc adipiscing, metus sollic itun molestie, urna augue dap ibus dui.</p>
								</div>
							</div>
						</div>
				</div>

				<!-- Recent News Ends -->
			</div>

		</div>
		<!-- Owl Carousel Ends -->
