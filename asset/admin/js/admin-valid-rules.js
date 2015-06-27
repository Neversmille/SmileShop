$(document).ready(function(){
	//Собственные правила
	$.validator.addMethod("product_url", function(value, element) {   return /[_-a-zA-Z0-9]+/.test(value); }, "Url может содержать только латинские буквы и символы '_' , '-'") ;
	$.validator.addMethod("price", function(value, element) {   return /^[0-9]{0,6}(.[0-9]{0,2})$/.test(value); }, "Цена должна быть в формате 12.23") ;
	$.validator.addMethod("latindigit", function(value, element) {   return /^[a-zA-Z0-9\s]+$/.test(value); }, "Может содержать только латинские буквы и цифры") ;



	$("#product_edit").validate({

		rules:{

			product_name:{
				required: true,
				minlength: 1,
				maxlength: 255
			},

			product_url:{
				required: true,
				minlength: 1,
				maxlength: 255,
				product_url: true
			},

			product_price:{
				required: true,
				minlength: 1,
				maxlength: 8,
				price: true
			},

			product_description:{
				required: true,
				minlength: 5,
				maxlength: 400
			},

			product_category_id:{
				required: true,
				minlength: 1,
				maxlength: 11,
				digits: true
			},

			product_firm_id:{
				required: true,
				minlength: 1,
				maxlength: 11,
				digits: true
			},

			product_hot:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			product_avaible:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			}
		}

	});

	$("#product_add").validate({

		rules:{

			product_name:{
				required: true,
				minlength: 1,
				maxlength: 255
			},

			product_url:{
				required: true,
				minlength: 1,
				maxlength: 255,
				product_url: true
			},

			product_price:{
				required: true,
				minlength: 1,
				maxlength: 8,
				price: true
			},

			product_description:{
				required: true,
				minlength: 5,
				maxlength: 400
			},

			product_category_id:{
				required: true,
				minlength: 1,
				maxlength: 11,
				digits: true
			},

			product_firm_id:{
				required: true,
				minlength: 1,
				maxlength: 11,
				digits: true
			},

			product_hot:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			product_avaible:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			}
		}

	});

	$("#firm_edit").validate({

		rules:{

			firm_id:{
				required: true,
				minlength: 1,
				maxlength: 11,
				digits: true
			},

			firm_name:{
				required: true,
				minlength: 1,
				maxlength: 30,
				latindigit: true
			}
		}

	});

	$("#firm_add").validate({

		rules:{

			firm_name:{
				required: true,
				minlength: 1,
				maxlength: 30,
				latindigit: true
			}
		}

	});

	$("#order_edit").validate({

		rules:{

			order_status:{
				required: true,
				minlength: 1,
				maxlength: 30,
				range: [0,3]
			}
		}

	});

	$("#review_edit").validate({

		rules:{

			review_is_delete:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,3]
			}
		}

	});

	$("#slide_add").validate({

		rules:{

			slider_product_id:{
				required: true,
				minlength: 1,
				maxlength: 11,
				digits: true
			},

			slider_position:{
				required: true,
				minlength: 1,
				maxlength: 2,
				digits: true
			},

			slider_is_active:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			slider_product_name:{
				required: true,
				minlength: 1,
				maxlength: 255
			},

			slider_description:{
				required: true,
				minlength: 5,
				maxlength: 400
			}
		}

	});

	$("#slide_edit").validate({

		rules:{

			slider_id:{
				required: true,
				minlength: 1,
				maxlength: 11,
				digits: true
			},

			slider_position:{
				required: true,
				minlength: 1,
				maxlength: 2,
				digits: true
			},

			slider_is_active:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			slider_product_name:{
				required: true,
				minlength: 1,
				maxlength: 255
			},

			slider_description:{
				required: true,
				minlength: 5,
				maxlength: 400
			}
		}

	});

	$("#admin_edit").validate({

		rules:{

			name:{
				required: true,
				minlength: 2,
				maxlength: 40
			},

			email:{
				required: true,
				minlength: 5,
				maxlength: 40,
				email: true
			},

			is_active:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			allow_orders:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			allow_products:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			allow_firms:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			allow_reviews:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			allow_slider:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			allow_admins:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			}

		}

	});

	$("#admin_add").validate({

		rules:{

			name:{
				required: true,
				minlength: 2,
				maxlength: 40
			},

			email:{
				required: true,
				minlength: 5,
				maxlength: 40,
				email: true
			},

			is_active:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			password:{
				required: true,
				minlength: 5,
				maxlength: 20
			},

			confpass:{
				required: true,
				minlength: 5,
				maxlength: 20
			},

			allow_orders:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			allow_products:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			allow_firms:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			allow_reviews:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			allow_slider:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			},

			allow_admins:{
				required: true,
				minlength: 1,
				maxlength: 1,
				range: [0,1]
			}

		}

	});

	$("#admin-edit-pass").validate({

		rules:{

			admin_id:{
				required: true,
				minlength: 1,
				maxlength: 11,
				digits: true
			},

			password:{
				required: true,
				minlength: 5,
				maxlength: 20
			},

			confpass:{
				required: true,
				minlength: 5,
				maxlength: 20
			}

		}

	});

	$("#edit-profile").validate({

		rules:{

			name:{
				required: true,
				minlength: 2,
				maxlength: 40
			}

		}

	});

	$("#edit-pass").validate({

		rules:{

			oldpass:{
				required: true,
				minlength: 5,
				maxlength: 20
			},

			newpass:{
				required: true,
				minlength: 5,
				maxlength: 20
			},

			confpass:{
				required: true,
				minlength: 5,
				maxlength: 20
			}

		}

	});


});

jQuery.extend(jQuery.validator.messages, {
    required: "Поле обязательно для заполнения",
    email: "Неверный формат почтовой почты",
    date: "Please enter a valid date",
    number: "Введенные данные должны быть числом",
    digits: "Введите только цифровые значения",
    creditcard: "Please enter a valid credit card number",
    maxlength: jQuery.validator.format("Поле должно содержать не более {0} символов"),
    minlength: jQuery.validator.format("Поле должно содержать не менее {0} символов"),
    rangelength: jQuery.validator.format("Значение должно быть в диапазоне от {0} до {1} длиной"),
    range: jQuery.validator.format("Введенное значение должно быть в диапазоне от {0} до {1}"),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}"),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}")
});
