<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {

	/*
	*	Получение информации о товаре по url
	*	@param string $url
	*	@return array - информация о товаре
	*	@return array array() - если нет товара с таким url
	*/
	public function get_product_info_by_url($url){
		if(!is_string($url)){
			return array("error" => "некорректный тип аргумента");
		}
		$product_info = $this->db->join('firms', 'product_firm = firm_id', 'left')
										->join('categories', 'product_category_id = category_id', 'left')
										->where('product_url', $url)
										->get('products')
										->result_array();

		if (empty($product_info)){
			return array("error" => "информация по данному продукту не найдена");
		}else {
			return  array("data" => $product_info[0]);
		}
	}


	/*
	*	Обновление  последних 10 просмотренных товаров
	*	@param array $product_info - информация о просмотренном товаре
	*/
	public function update_recent_items($product_info){
		if(!is_array($product_info)){
			return array("error" =>"некорректный тип аргумента");
		}

		$recent_items =  $this->session->userdata('recent_items');
		if(!$recent_items){
			$recent_items = array();
		}

		$recent_items[$product_info["product_id"]] = $product_info;
		if (count($recent_items)>10) {
			array_shift($recent_items);
		}
		
		$this->session->set_userdata(array("recent_items"=>$recent_items));
		return array("data" => true);
	}
}
