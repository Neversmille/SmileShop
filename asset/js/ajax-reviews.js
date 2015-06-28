$(document).ready(function () {
    //Установка событий
	setReviewsMore();
	showMoreEvent();
	//Фиксируем сколько товаров отображается на одной странице
	window.per_page =  $(".reviews-wrap").find(".item-review").length;
});

//Установка кнопки "Показать еще"
function setReviewsMore(){

	showmore = '<div class="reviews-show-more ">'+
						'<div class="reviews-show-more-text btn btn-default">'+
								'<i class="fa fa-refresh"></i>'+
								'показать еще комментарии'
						'</div>'+
					'</div>';

	//Проверяем  есть дальше страницы в пагинаторе
	if ($(".paging .current").next("a").length){
		$(".reviews-wrap").append(showmore);
	}
}

//Событие по нажатию кнопки "Показать еще"
function showMoreEvent(){
	$(".reviews-show-more").click(function(){
		console.log("show-more-click");
		$('.reviews-show-more-text i').addClass("fa-spin");
		
			Reviews.more(per_page);

    });
}


var Reviews = {

	/*
	*	Функция подгрузки товаров
	*	@param per_page - кол-во товаров на странице
	*/
	more: function(per_page){

			//Получаем необходимые данные
			var num = per_page;
			var offset = $(".reviews-wrap").find(".item-review").length;

			var msg = {};

			//Формируем данные для ajax запроса

			msg.num = +per_page;
			msg.offset = +offset;
			console.log(" msg.num",msg.num);
			console.log("msg.offset",msg.offset);


	         $.ajax({
	            type: 'POST',
	            url: '/ajax/reviews_show_more',
	            data: msg,
	            success: function(data){

	              console.log("response /ajax/reviews_show_more" ,data);
				reviews = "";
				for (var i = 0; i < data.reviews.length; i++) {
					if(data.reviews[i].review_file != null ) {
						file = '<div class="item-review-file">Прикрепленный файл: <a href="asset/upload/reviews/'+data.reviews[i].review_file+'" class="commentItem-file" download>'+data.reviews[i].review_filename+'<i class="fa fa-file-photo-o"></i></a></div>';
					}else{
						file ='';
					}
					reviews+= '<div class="item-review">'+
						'<p class="rmeta">'+data.reviews[i].review_time+'</p>'+
						'<p>'+data.reviews[i].review_text+'</p>'+file+'</div>';
				}


				//Удаляем кнопку показать еще
				$(".reviews-show-more").remove();
				if ($(".paging .current").next("a").text()!=">") {
					next_page = $(".paging .current").next("a").text();
					$(".paging .current").next("a").replaceWith("<span class='current'>"+next_page+"</span>");
				}

				$(".reviews-wrap").append(reviews);

				//Проверяем не выходит ле следующее смещение за пределы кол-ва товара
				if (msg.offset+msg.num< data.reviews_count) {
					setReviewsMore();
					showMoreEvent();
				}else{
					$(".paging").remove();
				}


	            },
	            error:  function(xhr, str){
	                console.log('Возникла ошибка: ' + xhr.responseCode);
					$(".reviews-show-more-text").text('произошла ошибка =(');
					$('.reviews-show-more i').removeClass("fa-spin");
					$(".reviews-show-more-text, .reviews-show-more-icon").addClass("color");
	            }
	        });

	}

}
