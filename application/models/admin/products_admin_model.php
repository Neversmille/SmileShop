<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products_admin_model extends CI_Model {

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

	public function get_products_count(){
		$count = $this->db->count_all_results('products');
		return $count;
	}

	/*
	*	Получение списка товаров
	*	@param int $num - колво
	*	@param int $offset - смещение
	*/
	public function get_products($num,$offset){
		$num = intval($num);
		$offset = intval($offset);

		$products = $this->db->join('categories', 'product_category_id = category_id', 'left')
									->order_by('product_id','desc')
									->get('products',$num,$offset)
									->result_array();

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
		if(!is_array($update_data)){
			return array("error" => "неверный тип аргумента");
		}

		$update = $this->db->where('product_id', $product_id)
								->update('products', $update_data);

		if($update){
			return array("data" => "товар обновлен");
		}else{
			return array("error" => "ошибка обновления товара");
		}
	}

	/*
	*	Добавление нового товара о товаре
	*	@param array $add_data - массив данных о товаре
	*/
	public function add_product($add_data){
		if(!is_array($add_data)){
			return array("error" => "неверный тип аргумента");
		}

		if($this->db->insert("products",$add_data)){
			return array("data" => true);
		}else{
			return array("error" => "ошибка добавления товара");
		}
	}

	/*
	*	Проверка уникальности url адресса товара
	*	@param string $url
	*/
	public function check_unique_url($url){
		if(!is_string($url)){
			return array("error" => "неверный аргумент");
		}

		$url_count = $this->db->where('product_url',$url)
									->count_all_results('products');

		if($url_count == 0) {
			return array("data" => true);
		}else{
			return array("error" => "url занят");
		}
	}

	/*
	*	Проверка уникальности url адресса и соответсвия его заданному id
	*	@param int $id
	*	@param string $url
	*/
	public function check_unique_edit_url($id,$url){
		$id = intval($id);
		if (!is_string($url)){
			return array("error" => "url должен быть строкой");
		}

		$id_url = $this->db->where("product_id",$id)
								->where("product_url",$url)
								->count_all_results('products');

		if ($id_url===1){
			return array("data" => true);
		}else{
			$check_url = $this->check_unique_url($url);
			if (isset($check_url["error"])){
				return  array("error" => "url занят");
			}else{
				return array("data" => true);
			}
		}
	}

	/*
	*    Формирование и инициализация массива опций пагинатора
	*    @param int $per_page
	*    @param int $page - текущий номер страницы
	*/
	function set_pagination($per_page,$page){
		$per_page = intval($per_page);
		$page = intval($page);
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admin/products';
		$config['per_page'] =$per_page;
		$config['cur_page'] = $page;
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'Вначало';
		$config['last_link'] = 'Последняя';
		$config['next_link'] = '&gt;';
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->get_products_count();
		$this->pagination->initialize($config);
	}

}
