<div class="checkout">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Checkout page title -->
                <h4 class="title"><i class="fa fa-shopping-cart"></i>Оформление заказа:</h4>
                <!-- Address and Shipping details form -->
                <div class="form form-small">
                    <!-- Sub title -->
                    <!-- Register form (not working)-->
                    <form class="form-horizontal" method="POST" action="<?=base_url().'order';?>"  id="order-form">

                        <div class="form-group">
                            <label class="control-label col-md-2" for="telephone">Имя: </label>
                            <div class="controls col-md-8 checkoutLabel">
                                <?=$client_info["client_name"];?>
                            </div>
                        </div>

                        <?php if( !is_null($client_info['client_lastname'])):?>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="telephone">Фамилия: </label>
                                <div class="controls col-md-8 checkoutLabel">
                                    <?=$client_info["client_lastname"];?>
                                </div>
                            </div>
                        <?php endif;?>

                        <div class="form-group">
                            <label class="control-label col-md-2" for="telephone">Телефон: </label>
                            <div class="controls col-md-8">
                                <?php if (is_null($client_info['client_phone'])):?>
                                    <input type="text" class="form-control " id="telephone" name="phone" placeholder="Введите номер телефона" value="<?=set_value('phone');?>"><?=form_error("phone");?>
                                <?php else:?>
                                    <input type="text" class="form-control " id="telephone" name="phone" value="<?=$client_info['client_phone'];?>"><?=form_error("phone");?>
                                <?php endif;?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2" for="text">Дополнительная информация:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="text" rows="5" name="text"><?=set_value('text');?></textarea>
                                <?=form_error("text");?>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="form-group">
                            <!-- Buttons -->
                            <div class="col-md-8 col-md-offset-3">
                                <div class="pull-left">
                                    <button type="submit" class="btn btn-danger" name="order">Заказать</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <hr />

            </div>
        </div>
    </div>
</div>
