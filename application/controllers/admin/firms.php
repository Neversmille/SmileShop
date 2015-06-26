<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Firms extends MY_Controller{

	public function __construct(){

        parent::__construct();
		$admin = $this->session->userdata('admin');
		if($admin["allow_firms"]==0){
			redirect('/admin/index/denied');
		}
    }

	public function index($current_page="null") {
		$this->output->enable_profiler(TRUE);
		$this->load->model('admin/firms_model');

		//Опции для пагинатора
		$per_page =2;
		$page = intval($current_page);


		$firms = $this->firms_model->get_firms($per_page,$page);
		if (isset($firms["error"])){
			$firms = array();
		}else{
			$firms = $firms["data"];
		}


		$this->firms_model->set_pagination($per_page,$page);

		$this->data["firms"] = $firms;
		$this->data["middle"] = $this->load->view("admin/firms/firms",$this->data,true);
		$this->data["title"] = "Фирмы";
		$this->admin_layout();

	}

	/*
	*	Страница редактирования товара
	*/
	public function add(){

		$this->load->model('admin/firms_model');

		//Проверяем отправлен ли запрос на регистрацию
		if(null!==$this->input->post('add')){
			$this->load->library('form_validation');
			$check = $this->form_validation->run('firm_add');

			//Проверям валидацию
			if($check){
				$add_data["firm_name"] = $this->input->post('firm_name');
				$add_firm = $this->firms_model->add_firm($add_data);
					if (isset($add_firm["error"])){
						show_404("ошибка добавления комментария");
					}
					redirect('/admin/firms');
			}
		}

		$this->load->helper('form');
		$this->data["middle"] = $this->load->view("admin/firms/firm_add_form",$this->data,true);
		$this->data["title"] = "Добавление товара";
		$this->admin_layout();

	}


	/*
	*	Страница редактирования товара
	*/
	public function firm($url = null,$update = false){
		if(is_null($url)) {
			show_404("Запрашиваемая фирма не найдена");
		}
		if($update){
			$this->data["update"] = true;
		}
		$this->load->model('admin/firms_model');
		//Проверяем отправлен ли запрос на регистрацию
		if(null!==$this->input->post('update_firm')){
			$this->edit_id = $this->input->post('firm_id',TRUE);
			$this->load->library('form_validation');
			$check = $this->form_validation->run('firm');
			//Проверям валидацию
			if($check){
				$firm_id = $this->input->post('firm_id');
				$update_data["firm_name"] = $this->input->post('firm_name');
				$update_firm = $this->firms_model->update_firm($firm_id,$update_data);
					if (isset($update_firm["error"])){
						show_404("ошибка добавления комментария");
					}
					redirect('/admin/firm/'.$update_data["firm_name"]."/update");
			}
		}

		$this->data["update_status"] = false;
		$firm_info = $this->firms_model->get_firm_info_by_name($url);
		if (isset($firm_info["error"])){
			show_404("Запрашиваемая фирма не найдена");
		}
		$firm_info = $firm_info["data"];
		$this->load->helper('form');
		$this->data["firm_info"] = $firm_info;
		$this->data["middle"] = $this->load->view("admin/firms/firm_edit_form",$this->data,true);
		$this->data["title"] = "Редактирование фирмы";
		$this->admin_layout();

	}




	/*
	*	callback функция проверки уникальности url
	*/
	public function check_unique_name($name){
		$check = $this->firms_model->check_unique_name($name);
		if(isset($check["data"])) {
			return true;
		}else{
			$this->form_validation->set_message('check_unique_name', 'Данный name  уже занят');
			return false;
		}
	}

	/*
	*	callback функция проверки уникальности url
	*/
	public function check_unique_edit_name($name){
		$check = $this->firms_model->check_unique_edit_name($this->edit_id,$name);
		if(isset($check["data"])) {
			return true;
		}else{
			$this->form_validation->set_message('check_unique_edit_name', 'Данный url  уже занят');
			return false;
		}
	}

}
