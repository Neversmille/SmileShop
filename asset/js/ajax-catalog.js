$(document).ready(function () {
    //Установка событий
	setCatalogMore();
	showMoreEvent();
	//Фиксируем сколько товаров отображается на одной странице
	window.per_page =  $(".catalogItems").find(".item").length;
});

//Установка кнопки "Показать еще"
function setCatalogMore(){

	showmore = '<div class="col-md-4 col-sm-6 catalog-show-more">'+
						'<div class="more-item ">'+
							'<div class="catalog-show-more-icon">'+
								'<i class="fa fa-refresh"></i>'+
							'</div>'+
							'<div class="catalog-show-more-text">показать еще...</div>'+
						'</div>'+
					'</div>';

	//Проверяем  есть дальше страницы в пагинаторе
	if ($(".paging .current").next("a").length){
		$(".catalogItems").append(showmore);
	}
}

//Событие по нажатию кнопки "Показать еще"
function showMoreEvent(){
	$(".catalog-show-more").click(function(){
		console.log("show-more-click");
		$('.catalog-show-more-icon i').addClass("fa-spin");
		// Catalog.more(per_page);

		//Эмитация загрузки
		setTimeout(function(){
			Catalog.more(per_page);
		}, 2000);
    });
}


var Catalog = {

	/*
	*	Функция подгрузки товаров
	*	@param per_page - кол-во товаров на странице
	*/
	more: function(per_page){

			//Получаем необходимые данные
			var category_id = $(".breadcrumb .category").attr('data-category');
			var next_page = $(".paging .current").next("a").text();
			var order = $(".catalog-order").attr('data-order');
			var firm = $(".catalog-firms .active").text();
			var offset = $(".breadcrumb").attr("data-product");

			var msg = {};
			//Формируем данные для ajax запроса

	         msg.category_id = category_id;
			msg.per_page = per_page;
			msg.offset = +offset+per_page;
			msg.order = order;
			msg.firm = firm;

			console.log(" msg.category_id", msg.category_id);
			console.log("msg.per_page",msg.per_page);
			console.log("msg.offset",msg.offset);
			console.log("msg.order",msg.order);
			console.log("msg.firm",msg.firm);

	         $.ajax({
	            type: 'POST',
	            url: '/ajax/catalog_show_more',
	            data: msg,
	            success: function(data){

				if (data=="false") {
					$(".catalog-show-more-text").text('произошла ошибка =(');
					$('.catalog-show-more-icon i').removeClass("fa-spin");
					$(".catalog-show-more-text, .catalog-show-more-icon").addClass("color");
					return false;
	            	}
				//Меняем offset отображаемого товара
				$(".breadcrumb").attr("data-product",msg.offset);

	              console.log("response /ajax/catalog_show_more" ,data);

				//Url проекта
				baseurl = "http://codeigniter.loc/";


				//Формируем строку для вставки в dom дерево
				products = "";
				for (var i = 0; i < data.products.length; i++) {
					products+= '<div class="col-md-4 col-sm-6">'+
						'<div class="item">'+
							'<div class="item-image">'+
								'<a href="'+baseurl+'product/'+data.products[i].product_url+'"><img src="/asset/upload/catalog/'+data.products[i].product_img+'" alt="" class="img-responsive" /></a>'+
							'</div>'+
							'<div class="item-details ">'+
								'<h5><a href="'+baseurl+'product/'+data.products[i].product_url+'">'+data.products[i].product_name+'</a>'+
							'</h5>'+
								'<div class="clearfix">'+
									'<p class="color capitalize">'+data.products[i].product_firm+'</p>'+
							'</div>'+
								'<p>'+data.products[i].product_description+'</p>'+
								'<hr />'+
								'<div class="item-price pull-left">'+data.products[i].product_price+' грн</div>'+
								'<div class="button pull-right product-add-to-order">'+
								'<input class="product-amount" type="hidden" value=1>'+
									'<a class="itemsAdd product-add" href="javascript:void( 0 )" data-id="'+data.products[i].product_id+'">В корзину</a>'+
								'</div>'+
								'<div class="clearfix"></div>'+
							'</div>'+
						'</div>'+
					'</div>';
				}

				//Удаляем кнопку показать еще
				$(".catalog-show-more").remove();
				if ($(".paging .current").next("a").text()!=">") {
					$(".paging .current").next("a").replaceWith("<span class='current'>"+next_page+"</span>");
				}

				//Дорисовуем полученные продукты
				$(".catalogItems").append(products);
				setProductEvents();
				//Проверяем не выходит ле следующее смещение за пределы кол-ва товара
				if (msg.offset+per_page< data.total_rows) {
					setCatalogMore();
					showMoreEvent();
				}else{
					$(".paging").remove();
				}

	            },
	            error:  function(xhr, str){
	                console.log('Возникла ошибка: ' + xhr.responseCode);
					$(".catalog-show-more-text").text('произошла ошибка =(');
					$('.catalog-show-more-icon i').removeClass("fa-spin");
					$(".catalog-show-more-text, .catalog-show-more-icon").addClass("color");
	            }
	        });

	}

}
