<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends MY_Controller{

	public function __construct(){

		parent::__construct();
		$admin = $this->session->userdata('admin');
		if($admin["allow_admins"]==0){
			redirect('/admin/index/denied');
		}
		$this->load->model('admin/admins_model');

	}

	public function index($current_page="null") {

		//Опции для пагинатора
		$per_page =1;
		$page = intval($current_page);

		//Параметр смещения для запроса
		if($page == 0){
			$offset =0;
		} else{
			$offset = ($page-1)*$per_page;
		}

		$admins = $this->admins_model->get_admins($per_page,$offset);
		if (isset($admins["error"])){
			$admins = array();
		}else{
			$admins = $admins["data"];
		}

		$this->admins_model->set_pagination($per_page,$page);

		$this->data["admins"] = $admins;
		$this->data["middle"] = $this->load->view("admin/admins/admins",$this->data,true);
		$this->data["title"] = "Администраторы";
		$this->admin_layout();

	}

	/*
	*	Добавление администратора
	*/
	public function add(){

		if(null!==$this->input->post('add')){
			$this->load->library('form_validation');
			$check = $this->form_validation->run('add_new_admin');

			//Проверям валидацию
			if($check){
				$add_data["admin_name"] = $this->input->post('name');
				$add_data["admin_email"] = $this->input->post('email');
				$add_data["allow_orders"] = $this->input->post('allow_orders');
				$add_data["allow_products"] = $this->input->post('allow_products');
				$add_data["allow_firms"] = $this->input->post('allow_firms');
				$add_data["allow_reviews"] = $this->input->post('allow_reviews');
				$add_data["allow_slider"] = $this->input->post('allow_slider');
				$add_data["allow_admins"] = $this->input->post('allow_admins');
				$password = $this->input->post('password');
				$this->load->library('passwordhash');
				$add_data["admin_password"] = $this->passwordhash->HashPassword($password);
				$add_admin = $this->admins_model->add_admin($add_data);
				if (isset($add_admin["error"])){
					show_404("ошибка добавления комментария");
				}
				redirect('/admin/admins');
			}

		}

		$this->load->helper('form');
		$this->data["middle"] = $this->load->view("admin/admins/admin_add_form",$this->data,true);
		$this->data["title"] = "Добавление администратора";
		$this->admin_layout();

	}


	/*
	*	Редактирование информации администратора
	*/
	public function editinfo($id){

		//Проверяем отправлен ли запрос на регистрацию
		$id = intval($id);

		$admin_info = $this->admins_model->get_admin_all_data($id);
		if(isset($admin_info["error"])){
			show_404("нет такого админа");
		}
		$admin_info = $admin_info["data"];

		if(null!==$this->input->post('edit')){
			$this->load->library('form_validation');
			$check = $this->form_validation->run('edit_admin');
			//Проверям валидацию
			if($check){
				$edit_data["admin_name"] = $this->input->post('name');
				$edit_data["admin_email"] = $this->input->post('email');
				$edit_data["admin_is_active"] = $this->input->post('is_active');
				$edit_data["allow_orders"] = $this->input->post('allow_orders');
				$edit_data["allow_products"] = $this->input->post('allow_products');
				$edit_data["allow_firms"] = $this->input->post('allow_firms');
				$edit_data["allow_reviews"] = $this->input->post('allow_reviews');
				$edit_data["allow_slider"] = $this->input->post('allow_slider');
				$edit_data["allow_admins"] = $this->input->post('allow_admins');
				$edit_admin = $this->admins_model->edit_admin_info($id,$edit_data);
				if (isset($edit_admin["error"])){
					show_404("ошибка добавления комментария");
				}
				redirect('/admin/admins');
			}
		}

		$this->data["admin_info"] = $admin_info;
		$this->data["admin_id"] = $id;
		$this->load->helper('form');
		$this->data["middle"] = $this->load->view("admin/admins/admin_edit_form",$this->data,true);
		$this->data["title"] = "Редактирование учетной записи администратора";
		$this->admin_layout();

	}

	/*
	*	Изменения пароля администратора
	*/
	public function editpass($id){

		$id = intval($id);

		if(null!==$this->input->post('edit_pass')){
			$this->load->library('form_validation');
			$check = $this->form_validation->run('edit_admin_pass');
			//Проверям валидацию
			if($check){
				$pass =  $this->input->post('password');
				$this->load->library('passwordhash');
				$pass  = $this->passwordhash->HashPassword($pass);
				$edit_pass = $this->admins_model->edit_admin_pass($id,$pass);
				if (isset($edit_pass["error"])){
					show_404("ошибка добавления комментария");
				}
				redirect('/admin/admins');
			}
		}

		$this->data["admin_id"] = $id;
		$this->load->helper('form');
		$this->data["middle"] = $this->load->view("admin/admins/admin_edit_pass_form",$this->data,true);
		$this->data["title"] = "Редактирование учетной записи администратора";
		$this->admin_layout();

	}




	/*
	*	Callback  уникальности email
	*	@param string $email
	*/
	public function unique_email($email){

		$check = $this->admins_model->check_email($email);
		if(isset($check["data"])) {
			return true;
		}else{
			$this->form_validation->set_message('unique_email', 'Пользователь с таким eMail уже зарегистрирован');
			return false;
		}
	}

	/*
	*	Callback проверки статуса
	*	@param int $value
	*/
	public function check_is_active($value){

		$value = intval($value);
		if($value===1||$value===0){
			return true;
		}else{
			$this->form_validation->set_message('check_is_active', 'неверный параметр');
			return false;
		}
	}

}
