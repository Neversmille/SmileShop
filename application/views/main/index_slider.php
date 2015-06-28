<?php if(!empty($slides)):?>
	<div class="container flex-main">
		<div class="row">
			<div class="col-md-12">
				<div class="flex-image flexslider">
					<ul class="slides">
						<!-- Each slide should be enclosed inside li tag. -->
						<?php foreach($slides as $slide):?>
							<!-- Slide #1 -->
							<li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
								<!-- Image -->
								<img class="main-slider-img" src="asset/upload/slider/<?=$slide['slider_image'];?>" alt="" draggable="false">
								<!-- Caption -->
								<div class="flex-caption">
									<!-- Title -->
									<h3><?=$slide['product_name'];?> - <span class="color"><?=$slide['product_price'];?> грн.</span></h3>
									<!-- Para -->
									<p><?=$slide['slider_description'];?></p>
									<div class="button">
										<a href="/product/<?=$slide['product_url'];?>">Подробнее</a>
									</div>
								</div>
							</li>
						<?php endforeach;?>
					</ul>
					<ul class="flex-direction-nav"><li><a class="flex-prev" href="#">Previous</a></li><li><a class="flex-next" href="#">Next</a></li></ul></div>

				</div>
			</div>
		</div>
	<?php endif;?>
