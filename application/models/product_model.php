<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {

	/*
	*	Получение информации о товаре по url
	*	@param string $url
	*	@return array - информация о товаре
	*	@return array array() - если нет товара с таким url
	*/
	public function get_product_info_by_url($url){
		$product_info = $this->db->where('product_url', $url)
					->get('products')
					->result_array();
		if (empty($product_info)){
			return array();
		}else {
			return $product_info[0];
		}
	}


	/*
	*	Обновление  последних 10 просмотренных товаров
	*	@param array $product_info - информация о просмотренном товаре
	*/
	public function update_recent_items($product_info){
		$recent_items =  $this->session->userdata('recent_items');
		if(!$recent_items) {
			$recent_items = array();
		}
		array_push($recent_items, $product_info);
		if (count($recent_items)>10) {
			array_shift($recent_items);
		}
		$this->session->set_userdata(array("recent_items"=>$recent_items));
	}


}
