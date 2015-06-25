$(document).ready(function () {

	$(".parse-link").click(function(){

		parse = '<div class="control-group">'+
  					'<label class="control-label">Название на price.ua:</label>'+
  						'<div class="controls">'+
  							'<input type="text" name="product_name" value="" class="span3 m-wrap"><button class="parse btn btn-success product_add">Спарсить</button></div></div>';

		$(".parse-wrap").append(parse);
		parseEvent();

	});



});


function parseEvent() {

	console.log('parseEvent');
	$(".parse").click(function(){
		val = $(this).closest(".controls").find('input').val();
		makeparse(val);
	});
}

function makeparse(name){
	var msg = {};
	msg.name = name;
	$.ajax({
		type: 'POST',
		url: '/ajax/parse',
		data: msg,
		success: function(data){
			console.log("response ajax/parse:" ,data[0].data);
			data = data[0].data;
			console.log(data.product_name);

			$(".product_name").val(data.product_name);
			$(".product_url").val(data.product_url);
			$(".product_description").val(data.product_descr);
			$(".product_price").val(data.product_price);
			img = '<div class="control-group"><div class="controls product_preview">'+
				'<img src='+data.product_img+'>'+
				'</div>'+
				'<label class="control-label">Изображение:</label>'+
				'<div class="controls"><input name="parse_img" class="span6" value='+data.product_img+'></div>'+
			'</div>';
			$(".img-wrap").append(img);
		},
		error:  function(xhr, str){
			console.log('Возникла ошибка: ' + xhr.responseCode);
		}
	});

}
