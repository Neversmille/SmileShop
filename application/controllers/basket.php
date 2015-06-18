<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Basket extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

	public function index(){
		$this->load->model('basket_model');
		$this->data["basket"] = $this->session->userdata('basket');
		// $this->data["basket"] = array();
		$this->data["title"] = "Корзина покупателя SmileShop";
		$this->middle = 'basket/index';
		$this->layout();
	}



}
