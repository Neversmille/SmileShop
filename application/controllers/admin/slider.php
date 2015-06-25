<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends MY_Controller{

	public function __construct(){

        parent::__construct();
    }

	public function index() {
		$this->output->enable_profiler(TRUE);
		$this->load->model('admin/slider_admin_model');
		$slides = $this->slider_admin_model->get_slides();
		if(isset($slides["error"])){
			$slides = array();
		}else{
			$slides = $slides["data"];
		}
		$this->data["slides"] = $slides;
		$this->data["middle"] = $this->load->view("admin/slider/index",$this->data,true);
		$this->data["title"] = "Отзывы";
		$this->admin_layout();

	}

	public function add() {
		$this->output->enable_profiler(TRUE);
		$this->load->model('admin/slider_admin_model');
		$this->load->helper('form');


		//Проверяем был ли отправлен комментарий
		if(null!==$this->input->post('slide_add')){

			$this->load->library('form_validation');
			$check = $this->form_validation->run('slide_add');
			$this->data["product_id"] ='';

			//Если поля прошли валидацию, то пытаемся добавить запись в бд, если валидация
			//не удалась, то грузим форму с теми же данными и выводим ошибки
			if ($check == TRUE){

				$insert["slider_product_id"] = $this->input->post('slider_product_id');
				$insert["slider_position"] = $this->input->post('slider_position');
				$insert["slider_is_active"] = $this->input->post('slider_is_active');
				$insert["slider_product_name"] = $this->input->post('slider_product_name');
				$insert["slider_description"] = $this->input->post('slider_description');

				// var_dump($_FILES); die();
				//Получаем имя загруженного файла для проверки далее был ли загружен вообще файл
				$tmp_name = $_FILES["product_img"]["tmp_name"];

				//Проверяем был ли загружен вообще файл, если был то обрабатываем его,
				//если нет - то добавляем коммент
				if (is_uploaded_file($tmp_name)) {

					$file = $this->upload_file();

					//Проверяем удалась ли загрузка файла, либо возникла ошибка
					if ($file["result"]) {
						$insert["slider_image"] = $file["file_name"];
						$add_slide = $this->slider_admin_model->add_slide($insert);
						if (isset($add_slide["error"])){
							show_404("ошибка добавления комментария");
						}
						redirect("admin/slider");
					}else{
						$this->data["file_error"] = $file["file_error"];
						$this->data["product_id"] = $insert["slider_product_id"] ;
					}

				}else{
					$this->data["file_error"] = "ошибка загрузки файла";
						$this->data["product_id"] = $insert["slider_product_id"] ;
				}

			}
		}

		$this->data["middle"] = $this->load->view("admin/slider/slide_add_form",$this->data,true);
		$this->data["title"] = "Добавление слайда";
		$this->admin_layout();
	}

	public function edit($id) {
		$id = intval($id);
		$this->output->enable_profiler(TRUE);
		$this->load->model('admin/slider_admin_model');
		$this->load->helper('form');
		//Проверяем был ли отправлен комментарий
		if(null!==$this->input->post('slide_edit')){
			$this->load->library('form_validation');
			$check = $this->form_validation->run('slide_add');
			//Если поля прошли валидацию, то пытаемся добавить запись в бд, если валидация
			//не удалась, то грузим форму с теми же данными и выводим ошибки
			if ($check == TRUE){
				$slider_id = $this->input->post('slider_id');
				$insert["slider_position"] = $this->input->post('slider_position');
				$insert["slider_is_active"] = $this->input->post('slider_is_active');
				$insert["slider_product_name"] = $this->input->post('slider_product_name');
				$insert["slider_description"] = $this->input->post('slider_description');
				//Получаем имя загруженного файла для проверки далее был ли загружен вообще файл
				$tmp_name = $_FILES["product_img"]["tmp_name"];
				//Проверяем был ли загружен вообще файл, если был то обрабатываем его,
				//если нет - то добавляем коммент
				if (is_uploaded_file($tmp_name)) {
					$file = $this->upload_file();
					//Проверяем удалась ли загрузка файла, либо возникла ошибка
					if ($file["result"]) {
						$insert["slider_image"] = $file["file_name"];
						$edit_slide = $this->slider_admin_model->edit_slide($slider_id,$insert);
						if (isset($edit_slide["error"])){
							show_404("ошибка добавления комментария");
						}
						redirect("admin/slider");
					}else{
						$this->data["file_error"] = $file["file_error"];
					}
				}
				$edit_slide = $this->slider_admin_model->edit_slide($slider_id,$insert);
				redirect("admin/slider");
			}
		}
		$slide_info = $this->slider_admin_model->get_slide_info($id);
		if(isset($slide_info["error"])){
			show_404("нет такого слайда");
		}else{
			$slide_info = $slide_info["data"];
		}
		$this->data["slide_info"] = $slide_info;
		$this->data["middle"] = $this->load->view("admin/slider/slide_edit_form",$this->data,true);
		$this->data["title"] = "Редактирование слайда";
		$this->admin_layout();
	}

	public function ajax() {
		$this->output->set_content_type('application/json');
		$id = intval($this->input->post("id",true));
		$this->load->model('admin/slider_admin_model');
		$product_info = $this->slider_admin_model->get_product_info($id);
		if (isset($product_info["error"])){
			$this->output->set_output(json_encode("ошибочка"));
		}else{
			$this->output->set_output(json_encode($product_info["data"]));
		}

	}

	/*
	*	Загрузка файла
	*	@return array с информацией о загруженном файле
	*/
	/*
	*	Загрузка файла
	*	@return array с информацией о загруженном файле
	*/
	private function upload_file() {

		//Правила загружаемного файла
		$config['upload_path'] = 'asset/upload/slider';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '10000';
		$config['encrypt_name'] = TRUE;
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload',$config);

		//Пытаемся загрузить файл
		if ($this->upload->do_upload('product_img')) {
			$info = $this->upload->data();
			return array("result" => true, "file_name" => $info["file_name"], "orig_name" => $info["orig_name"]);
		}else {
			return array("result" => false, "file_error" => $this->upload->display_errors());
		}

	}

	/*
	*	Callback проверки review_is_delete
	*	@param int $value
	*/
	public function check_is_active($value){
		$value = intval($value);
		if($value===1||$value===0){
			return true;
		}else{
			return false;
		}
	}


}
