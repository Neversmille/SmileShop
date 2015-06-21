<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller{

	public function __construct(){

        parent::__construct();
    }

	public function index($category = '') {

		$this->output->enable_profiler(TRUE);
		$this->load->helper('security');
		$category = xss_clean($category);
		$this->load->model('admin/products_model');

		$products_category = $this->products_model->get_products_category();

		if (isset($products_category["error"])){
			$products_category = array();
		}else{
			$products_category = $products_category["data"];
		}

		$products = $this->products_model->get_products($category);

		if (isset($products["error"])){
			$products = array();
		}else{
			$products = $products["data"];
		}

		$this->load->model('catalog_model');

		$category_name = $this->catalog_model->get_category_info($category);

		if(isset($category_name["error"])){
			$category_name = '';
		}else{
			$category_name = $category_name["data"]["category_name"];
		}

		$this->data["category_name"] = $category_name;
		$this->data["category"] = $category;
		$this->data["products"] = $products;
		$this->data["products_category"] = $products_category;
		$this->data["products_category_menu"] = $this->load->view("admin/products/products_category_menu",$this->data,true);
		$this->data["middle"] = $this->load->view("admin/products/products",$this->data,true);
		$this->data["title"] = "Товары";
		$this->admin_layout();

	}

	/*
	*	Страница редактирования товара
	*/
	public function product($url = null,$update = false){

		if(is_null($url)) {
			show_404("Запрашиваемый товар не найден");
		}

		if($update){
			$this->data["update"] = true;
		}

		$this->load->model('admin/products_model');

		//Проверяем отправлен ли запрос на регистрацию
		if(null!==$this->input->post('update_product')){

			$this->load->library('form_validation');
			$check = $this->form_validation->run('product');

			//Проверям валидацию
			if($check){

				$product_id = $this->input->post('product_id');
				$update_data["product_name"] = $this->input->post('product_name');
				$update_data["product_url"] = $this->input->post('product_url');
				$update_data["product_price"] = $this->input->post('product_price');
				$update_data["product_description"] = $this->input->post('product_description');
				$update_data["product_category_id"] = $this->input->post('product_category_id');
				$update_data["product_hot"] = $this->input->post('product_hot');
				$update_data["product_avaible"] = $this->input->post('product_avaible');
				$update_data["product_firm"] = $this->input->post('product_firm_id');
				$tmp_name = $_FILES["product_img"]["tmp_name"];

				if (is_uploaded_file($tmp_name)) {

					$file = $this->upload_file();
					//Проверяем удалась ли загрузка файла, либо возникла ошибка
					if ($file["result"]) {

						$update_data["product_img"] = $file["file_name"];
						$update_product = $this->products_model->update_product($product_id,$update_data);
						if (isset($update_product["error"])){
							show_404("ошибка обновления данных товара");
						}

					}else{

						$this->data["file_error"] = $file["file_error"];

					}

				}else{


					$update_product = $this->products_model->update_product($product_id,$update_data);

					if (isset($update_product["error"])){
						show_404("ошибка добавления комментария");
					}

					redirect('/admin/product/'.$update_data["product_url"]."/update");
				}
					redirect('/admin/product/'.$update_data["product_url"]."/update");
			}

		}

		$this->data["update_status"] = false;

		$this->load->model('product_model');
		$product_info = $this->product_model->get_product_info_by_url($url);

		if (isset($product_info["error"])){
			show_404("Запрашиваемый товар не найден");
		}

		$product_info = $product_info["data"];

		$products_category = $this->products_model->get_products_category();

		if (isset($products_category["error"])){
			$products_category = array();
		}else{
			$products_category = $products_category["data"];
		}

		$products_firm = $this->products_model->get_products_firm();

		if (isset($products_firm["error"])){
			$products_firm = array();
		}else{
			$products_firm = $products_firm["data"];
		}

		$this->load->helper('form');
		$this->data["category"] = $product_info["category_alias"];
		$this->data["product_info"] = $product_info;
		$this->data["products_category"] = $products_category;
		$this->data["products_firm"] = $products_firm;
		$this->data["products_category_menu"] = $this->load->view("admin/products/products_category_menu",$this->data,true);
		$this->data["middle"] = $this->load->view("admin/products/product_edit_form",$this->data,true);
		$this->data["title"] = "Товары";
		$this->admin_layout();

	}

	/*
	*	Загрузка файла
	*	@return array с информацией о загруженном файле
	*/
	private function upload_file() {

		//Правила загружаемного файла
		$config['upload_path'] = 'asset/upload/catalog';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['encrypt_name'] = TRUE;
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload',$config);

		//Пытаемся загрузить файл
		if ($this->upload->do_upload("product_img")) {
			$info = $this->upload->data();
			return array("result" => true, "file_name" => $info["file_name"], "orig_name" => $info["orig_name"]);
		}else {
			return array("result" => false, "file_error" => $this->upload->display_errors());
		}

	}

}
