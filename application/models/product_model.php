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



}
