$(document).ready(function(){
	//Собственные правила
	$.validator.addMethod("product_url", function(value, element) {   return /[_-a-zA-Z0-9]+/.test(value); }, "Url может содержать только латинские буквы и символы '_' , '-'") ;
	$.validator.addMethod("price", function(value, element) {   return /^[0-9]{0,6}(.[0-9]{0,2})$/.test(value); }, "Цена должна быть в формате 12.23") ;
	$.validator.addMethod("latindigit", function(value, element) {   return /^[a-zA-Z0-9\s]+$/.test(value); }, "Может содержать только латинские буквы и цифры") ;



	$("#reviews").validate({

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

			text:{
                required: true,
                minlength: 5,
                maxlength: 400
			}

		}

	});

    $("#login").validate({

        rules:{

            email:{
                    required: true,
                minlength: 5,
                maxlength: 40,
                email: true
            },

            password:{
                required: true,
                minlength: 5,
                maxlength: 20
            }

        }

    });

    $("#register").validate({

        rules:{

            name:{
                required: true,
                minlength: 2,
                maxlength: 40
			},

            lastname:{
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

            password:{
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
			},

            lastname:{
                required: true,
                minlength: 2,
                maxlength: 40
			}

        }

    });

    $("#edit-profile-pass").validate({

        rules:{

            newpass:{
                required: true,
                minlength: 5,
                maxlength: 20
            },

            oldpass:{
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

    $("#order-form").validate({

        rules:{

            phone:{
                required: true,
                minlength: 7,
                maxlength: 20,
			  digits: true
            },

            text:{
                required: true,
                minlength: 5,
                maxlength: 400
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
    maxlength: jQuery.validator.format("Поле должно содержать не менее {0} символов"),
    minlength: jQuery.validator.format("Поле должно содержать не менее {0} символов"),
    rangelength: jQuery.validator.format("Значение должно быть в диапазоне от {0} до {1} длиной"),
    range: jQuery.validator.format("Введенное значение должно быть в диапазоне от {0} до {1}"),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}"),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}")
});
