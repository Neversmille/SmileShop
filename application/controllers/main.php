<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller{

	/*
	*	Главная страница сайта;
	*/
	public function index(){

			$this->load->model('catalog_model');
			$products = $this->catalog_model->get_random_hot_products(8);
			if (isset($products["error"])) {
				$products = array();
			}
			$products = $products["data"];
			$this->data["products"] = $products;
			$this->data["hot"] = $this->load->view("catalog/hot",$this->data,true);
			$this->data["index_slider"] = $this->load->view("main/index_slider",$this->data,true);
			$this->data["promo_menu"] = $this->load->view("catalog/promo_menu",$this->data,true);
			$this->data["title"] = "SmileShop - интернет магазин";
			$this->middle = 'main/index';
			$this->layout();
	}

}
