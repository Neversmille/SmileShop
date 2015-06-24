<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller{

	public function index($url=''){

		$this->load->helper('security');
		$url = xss_clean($url);

		$this->load->model('catalog_model');
		$this->load->model('product_model');

		$product_info = $this->product_model->get_product_info_by_url($url);
		if (isset($product_info["error"])){
			show_404("Запрашиваемый вами товар не найден2");
		}
		$product_info = $product_info["data"];

		$category_info = $this->catalog_model->get_category_info_by_id($product_info["product_category_id"]);
		if(isset($category_info["error"])){
			show_404("Запрашиваемый вами товар не найден3");
		}
		$category_info = $category_info["data"];

		$this->product_model->update_recent_items($product_info);
		if(isset($recent_items["error"])){
			show_404("Произошла непредвиденная ошибка, попробуйте повторить ваш запрос позже");
		}

		$firm_list = $this->catalog_model->get_category_firm_list($product_info["product_category_id"]);
		if (isset($firm_list["error"])){
			$firm_list = array();
		}else{
			$firm_list = $firm_list["data"];
		}

		$this->data["title"] = "SmileShop ".$product_info['product_name'];
		$this->data["category"] = $category_info["category_alias"];
		$this->data["category_name"] = $category_info["category_name"];
		$this->data["product_firm"] = $product_info["firm_name"];
		$this->data["firm_list"] = $firm_list;
		$this->data["firms"] = $this->load->view("catalog/firms",$this->data,true);
		$this->js[] = 'jquery.elevatezoom.js';
		$this->js[] = 'zoom.js';
		$this->data["product_info"] = $product_info;
		$this->middle = 'product/index';
		$this->layout();

	}

}
