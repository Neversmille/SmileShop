<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller{

	public function index($url=''){

		$this->load->helper('security');
		$url = xss_clean($url);
		if (empty($url)) {
			show_404();
		}

		//var_dump($url); die();

		$this->load->model('catalog_model');
		$this->load->model('product_model');

		$product_info = $this->product_model->get_product_info_by_url($url);

		if (empty($product_info)) {
			show_404();
		}

		$category_info = $this->catalog_model->get_category_info_by_id($product_info["product_category_id"]);
		if (empty($category_info)) {
			show_404();
		}

		$this->product_model->update_recent_items($product_info);
		$this->data["title"] = "SmileShop ".$product_info['product_name'];
		$this->data["category"] = $category_info["category_alias"];
		$this->data["category_name"] = $category_info["category_name"];
		$this->data["product_firm"] = $product_info["product_firm"];
		$this->data["firm_list"] = $this->catalog_model->get_category_firm_list($product_info["product_category_id"]);
		$this->data["firms"] = $this->load->view("catalog/firms",$this->data,true);
		$this->data["product_info"] = $product_info;
		$this->middle = 'product/index';
		$this->layout();

	}

}
