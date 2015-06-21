<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products_model extends CI_Model {

	/*
	*	Получение списка категорий товаров
	*/
	public function get_products_category(){

		$categories = $this->db->get('categories')
									->result_array();
		if(empty($categories)) {
			return array("error" => "нет категорий");
		}else{
			return array("data" => $categories);
		}

	}

	/*
	*	Получение списка товаров
	*/
	public function get_products($category){

		if(empty($category)){
			$products = $this->db->join('categories', 'product_category_id = category_id', 'left')
										->get('products')
										->result_array();
		}else{
			$products = $this->db->join('categories', 'product_category_id = category_id', 'left')
										->where('category_alias',$category)
										->get('products')
										->result_array();
		}

		if(empty($products)){
			return array("error" => "нет товара");
		}else{
			return array("data" => $products);
		}

	}

	/*
	*	Получение списка фирм
	*/
	public function get_products_firm(){

		$firms = $this->db->get('firms')
								->result_array();

		if(empty($firms)){
			return array("error" => "нет фирм");
		}else{
			return array("data" => $firms);
		}

	}

	/*
	*	Обновление данных о товаре
	*	@param int $product_id
	*	@param array $update_data - массив обновляемых данных
	*/
	public function update_product($product_id,$update_data){
		$product_id = intval($product_id);
		$update = $this->db->where('product_id', $product_id)
								->update('products', $update_data);
		if($update){
			return array("data" => "товар обновлен");
		}else{
			return array("error" => "ошибка обновления товара");
		}

	}



}
