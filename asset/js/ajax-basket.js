$(document).ready(function () {

    //Установка событий
    setProductEvents();
});

/*
*   События, которые будут отслеживаться
*/
function setProductEvents() {

    console.log("setProductEvents");

    $(".product-add").click(function(){

        product_id = $(this).closest('.product-add-to-order').find('.product-add').attr('data-id');
        console.log("action: product-add  product_id: ",product_id);

        product_amount = $(this).closest('.product-add-to-order').find('.product-amount').val();
        console.log("action: product-add  product_amount: ",product_amount);

        Basket.add(product_id,product_amount);

        curentAmount = +getBasketWidgetAmount();
        curentAmount = curentAmount+(+product_amount);
        setBasketWidgetAmount(curentAmount);

    });  


    /*
   * Уменьшение количества товара в корзине
   */
   $('.itemMinus').click(function(){

       //Текущая информация о товаре в корзине
       input = $(this).closest('.itemCountGroup').find('.itemCount');
       price = $(this).closest('tr').find('.price').text();
       cost = $(this).closest('tr').find('.itemsCost');
       itemId = $(this).closest('tr').find('.itemId').val();

       //Уменьшаем количество на 1
       count = input.val();
       count--;

       curentAmount = +getBasketWidgetAmount();
       curentAmount = curentAmount-1;

       //Если отрицательное кол-во, то устанавливаем 1
       if (count<=0) {
           count=1;
           curentAmount= curentAmount+1;
        }

       //Отправляем данные на сервер
       Basket.update(itemId,count);

       //Обновляем данные в корзине
       input.val(count);
       cost.text((count*price).toFixed(2));
       countTotalCost();


   });

   /*
   * Увеличение количества товара в корзине
   */
   $('.itemPlus').click(function(){

       //Текущая информация о товаре в корзине
       input = $(this).closest('.itemCountGroup').find('.itemCount');
       price = $(this).closest('tr').find('.price').text();
       cost = $(this).closest('tr').find('.itemsCost');
       itemId = $(this).closest('tr').find('.itemId').val();

       //Увеличиваем количество на 1
       count = input.val();
       count++;

       if (count>99) {
           count = 99;
           curentAmount = 99;
       }

      //Отправляем данные на сервер
       Basket.update(itemId,count);

       //Обновляем данные в корзине
       input.val(count);
       cost.text((count*price).toFixed(2));
       countTotalCost();

   });

   /*
   *   Удаление товара из корзины
   */
   $('.itemDelete').click(function(){

       //Текущая информация о товаре в корзине
       input = $(this).closest('.itemCountGroup').find('.itemCount');
       count = +input.val();
       itemNumber = $(this).closest('tr').find('.itemNumber').text();
       itemId = $(this).closest('tr').find('.itemId').val();

       //Отправляем действие на сервер
       Basket.delete(itemId);

       //Обновляем данные в корзине
       $(this).closest('tr').remove();
       countTotalCost();

       if($('.basketTable').children('tr').length==1){
           $('.view-cart-body').remove();
           $('.view-cart-wrap').append("<div class='col-md-12'><h3 class='title'>В вашей корзине пусто</h3><div class='row'>"+
           "<div class='col-md-4 col-md-offset-8'><div class='pull-right'><a href='/catalog' class='btn btn-default'>Продолжить покупки</a>"+
           "</div></div></div></div>");
       }


       curentAmount = +getBasketWidgetAmount();
       currentAmount = currentAmount-count;
       setBasketWidgetAmount(currentAmount);

   });

   /*
   *    Изменение количества данных при помощи клавишь
   */
   $('.itemCount').keyup(function(){

       //Текущая информация о товаре в корзине
        price = $(this).closest('tr').find('.price').text();
        cost = $(this).closest('tr').find('.itemsCost');
        itemId = $(this).closest('tr').find('.itemId').val();

        //Получаем данные о текущем количестве
        count = +$(this).val();
        //Если новое количество меньше 1 или не число - устанавливаем количество в 1
        if (count<1 || (!$.isNumeric(count)) ) {
            count = 1;
        }

        if (count>99) {
            count = 99;
        }

        //Отправляем данные на сервер
        Basket.update(itemId,count);

        //Обновляем данные в корзине
        $(this).closest('tr').find('.itemCount').val(count);
        cost.text((count*price).toFixed(2));
        countTotalCost();


      });

    /*
    *   Подсчет общей стоимости товаров  в корзине
    */
    function countTotalCost(){

        var totalCost = 0;

        //Просчитываем общую стоимость товаров в корзине
        $(".basketTable .itemsCost").each(function(){
            totalCost = totalCost + (+$(this).text());
        })

        //Устанавливаем новую общую стоимость
        $(".totalBasketCost").text(totalCost.toFixed(2));

    }

    $(".close-modal-cart").click(function(){
        $('#cartAdd').hide();
    });

    /*
    *   Обновление количества товара в корзине
    *   @param int amount - новое количество товара
    */
    function setBasketWidgetAmount(amount){
        currentAmount = $('.basket-item-count').text(amount);
    }

    /*
    *   Получение количества товара в корзине
    */
    function getBasketWidgetAmount(){
        currentAmount =$('.basket-item-count').text();
        return currentAmount;
    }

}

/*
*   Обьект для выполнения ajax запросов
*/
var Basket = {

    //Добавление товара в корзину
    add:function(id,amount){
        console.log("Basket.add id:",id," count: ",amount);
        var msg = {};
        msg.id = +id;
        msg.amount = +amount;
        $.ajax({
            type: 'POST',
            url: '/ajax/add',
            data: msg,
            success: function(data){
                console.log("response ajax/add:" ,data);
                $("#cartAdd").show();
            },
            error:  function(xhr, str){
                console.log('Возникла ошибка: ' + xhr.responseCode);
            }
        });
    },

    //Изменение количества товара в корзине
    update:function(id,amount){
        console.log("Basket.add id:",id," count: ",amount);
        var msg = {};
        msg.id = +id;
        msg.amount = +amount;
        $.ajax({
            type: 'POST',
            url: '/ajax/update',
            data: msg,
            success: function(data){
                console.log("response ajax/update:" ,data);
            },
            error:  function(xhr, str){
                console.log('Возникла ошибка: ' + xhr.responseCode);
            }
        });
    },

    //Удаление товара из корзины
    delete:function(id){
        console.log("Basket.delete id:",id);
        var msg = {};
        msg.id = +id;
        $.ajax({
            type: 'POST',
            url: '/ajax/delete',
            data: msg,
            success: function(data){
                console.log("response ajax/delete:" ,data);
            },
            error:  function(xhr, str){
                console.log('Возникла ошибка: ' + xhr.responseCode);
            }
        });
    }


}
