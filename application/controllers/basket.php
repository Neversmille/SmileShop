<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Basket extends MY_Controller {

    public function index(){
        $basket = $this->session->userdata('basket');
        if(!$basket){
            $basket = array();
        }
        
        $this->data["basket"] = $basket;
        $this->data["title"] = "Корзина покупателя SmileShop";
        $this->middle = 'basket/index';
        $this->layout();
    }

}
