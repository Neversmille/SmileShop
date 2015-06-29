$(document).ready(function () {
		parseEvent();
});


function parseEvent() {

	console.log('parseEvent');
	$(".get-product").click(function(){
		val = $(this).closest(".get-product-wrap").find('input').val();
		getproduct(val);
		loading = "<i class='fa fa-spinner fa-spin loading'></i>";
		$(".parse-price-ua").append(loading);
	});
}

function getproduct(id){
	var msg = {};
	msg.id = id;
	$.ajax({
		type: 'POST',
		url: '/admin/slider/ajax',
		data: msg,
		success: function(data){
			console.log("response ajax/getproduct:" ,data);
			$(".slider_product_name").val(data.product_name);
			$(".product_price").text(data.product_price+" грн");
			$("form").removeClass("hidden");
			$("input[name = slider_product_id]").val(data.product_id);
			$(".product_name").append('<div class="control-group">'+
				'<label class="control-label">Цена:</label>'+
				'<div class="controls col-md-8 checkoutLabel">'+data.product_price+' грн</div>'+
			'</div>');


			$(".loading").remove();
		},
		error:  function(xhr, str){
			console.log('Возникла ошибка: ' + xhr.responseCode);
		}
	});

}
