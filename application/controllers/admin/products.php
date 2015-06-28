<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller{

	public function __construct(){

        parent::__construct();
		$admin = $this->session->userdata('admin');
		if($admin["allow_products"]!=1){
			redirect('/admin/index/denied');
		}
    }

	public function index($current_page="null") {
		$this->load->model('admin/products_admin_model');
		//Опции для пагинатора
		$per_page = 10;
		$page = intval($current_page);

		$this->products_admin_model->set_pagination($per_page,$page);
		if($page == 0){
			$offset =0;
		} else{
			$offset = ($page-1)*$per_page;
		}
		$products= $this->products_admin_model->get_products($per_page,$offset);
		if (isset($products["error"])){
			$products = array();
		}else{
			$products = $products["data"];
		}

		$this->load->model('catalog_model');
		$this->data["products"] = $products;
		$this->data["middle"] = $this->load->view("admin/products/products",$this->data,true);
		$this->data["title"] = "Товары";
		$this->admin_layout();
	}

	/*
	*	Страница редактирования товара
	*/
	public function add($add = false){

		if($add){
			$this->data["add"] = true;
		}

		$this->load->model('admin/products_admin_model');

		//Проверяем отправлен ли запрос на регистрацию
		if(null!==$this->input->post('add')){

			$this->load->library('form_validation');
			$check = $this->form_validation->run('product_add');

			//Проверям валидацию
			if($check){
				$add_data["product_name"] = $this->input->post('product_name');
				$add_data["product_url"] = $this->input->post('product_url');
				$add_data["product_price"] = $this->input->post('product_price');
				$add_data["product_description"] = $this->input->post('product_description');
				$add_data["product_category_id"] = $this->input->post('product_category_id');
				$add_data["product_hot"] = $this->input->post('product_hot');
				$add_data["product_avaible"] = $this->input->post('product_avaible');
				$add_data["product_firm"] = $this->input->post('product_firm_id');



				$tmp_name = $_FILES["product_img"]["tmp_name"];

				if (is_uploaded_file($tmp_name)) {
					$file = $this->upload_file();
					//Проверяем удалась ли загрузка файла, либо возникла ошибка
					if ($file["result"]) {
						$add_data["product_img"] = $file["file_name"];
						$add_product = $this->products_admin_model->add_product($add_data);
						if (isset($add_product["error"])){
							show_404("ошибка добавления данных товара");
						}
					}else{
						$this->data["file_error"] = $file["file_error"];
					}
				}else{
					$img = $this->input->post('parse_img');
					if ($img) {
						$img = $this->file_upload_by_url($img);
						if(isset($img["data"])){
							$add_data["product_img"] = $img["data"];
						}
					}

					$add_product = $this->products_admin_model->add_product($add_data);
					if (isset($add_product["error"])){
						show_404("ошибка добавления комментария");
					}
					redirect('/admin/products');
				}
				redirect('/admin/products');
			}

		}

		$this->data["add_status"] = false;

		$products_category = $this->products_admin_model->get_products_category();
		if (isset($products_category["error"])){
			$products_category = array();
		}else{
			$products_category = $products_category["data"];
		}

		$products_firm = $this->products_admin_model->get_products_firm();
		if (isset($products_firm["error"])){
			$products_firm = array();
		}else{
			$products_firm = $products_firm["data"];
		}

		$this->load->helper('form');
		$this->data["products_category"] = $products_category;
		$this->data["products_firm"] = $products_firm;
		$this->data["middle"] = $this->load->view("admin/products/product_add_form",$this->data,true);
		$this->data["title"] = "Добавление товара";
		$this->admin_layout();
	}


	/*
	*	Страница редактирования товара
	*/
	public function product($url = null){
		if(is_null($url)) {
			show_404("Запрашиваемый товар не найден");
		}

		$this->load->model('admin/products_admin_model');

		//Проверяем отправлен ли запрос на регистрацию
		if(null!==$this->input->post('update_product')){

			$this->edit_id = $this->input->post('product_id',TRUE);
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
						$update_product = $this->products_admin_model->update_product($product_id,$update_data);
						if (isset($update_product["error"])){
							show_404("ошибка обновления данных товара");
						}
					}else{
						$this->data["file_error"] = $file["file_error"];
					}
				}else{
					$update_product = $this->products_admin_model->update_product($product_id,$update_data);
					if (isset($update_product["error"])){
						show_404("ошибка добавления комментария");
					}
					redirect('/admin/product/'.$update_data["product_url"]."/update");
				}
					redirect('/admin/product/'.$update_data["product_url"]."/update");
			}
		}


		$this->load->model('product_model');

		$product_info = $this->product_model->get_product_info_by_url($url);
		if (isset($product_info["error"])){
			show_404("Запрашиваемый товар не найден");
		}
		$product_info = $product_info["data"];

		$products_category = $this->products_admin_model->get_products_category();
		if (isset($products_category["error"])){
			$products_category = array();
		}else{
			$products_category = $products_category["data"];
		}
		$products_firm = $this->products_admin_model->get_products_firm();

		if (isset($products_firm["error"])){
			$products_firm = array();
		}else{
			$products_firm = $products_firm["data"];
		}

		$this->load->helper('form');
		$this->data["product_info"] = $product_info;
		$this->data["products_category"] = $products_category;
		$this->data["products_firm"] = $products_firm;
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


	/*
	*	callback функция проверки уникальности url
	*	@param string $url
	*/
	public function check_unique_url($url){
		$check = $this->products_admin_model->check_unique_url($url);
		if(isset($check["data"])) {
			return true;
		}else{
			$this->form_validation->set_message('check_unique_url', 'Данный url  уже занят');
			return false;
		}
	}


	/*
	*	callback функция проверки уникальности url
	*	@param string $url
	*/
	public function check_price($price){
		if(preg_match("/^[0-9]{0,6}(.[0-9]{0,2})$/",$price)){
			return true;
		}else{
			$this->form_validation->set_message('check_price', 'Неверный формат строки');
			return false;
		}
	}

	/*
	*	callback функция проверки уникальности urlпри редактировании url
	*	@param string $url
	*/
	public function check_unique_edit_url($url){
		$check = $this->products_admin_model->check_unique_edit_url($this->edit_id,$url);
		if(isset($check["data"])) {
			return true;
		}else{
			$this->form_validation->set_message('check_unique_edit_url', 'Данный url  уже занят');
			return false;
		}
	}



	private function file_upload_by_url($img_url){
		$handle = fopen($img_url, 'rb');
		$img = new Imagick();
		$img->readImageFile($handle);
		$format =$img->getImageFormat();
		$format = strtolower($format);
		if ($format=='gif' || $format=='jpg' || $format=='jpeg' || $format=='bmp'){
			$name = md5(time().rand(1,100));
			$img->writeImage('asset/upload/catalog/'.$name.'.'.$format);
			return array("data" => $name.'.'.$format);
		}

		return array("error" => "неверный формат файла");
	}

}
