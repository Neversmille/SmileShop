<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends MY_Controller{

	public function __construct(){
        parent::__construct();
		$this->load->model('admin/admins_model');
    }

	public function index($current_page="null") {

		//Опции для пагинатора
		$per_page =1;
		$page = intval($current_page);


		$admins = $this->admins_model->get_admins($per_page,$page);
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
	*	Страница редактирования товара
	*/
	public function add(){
		//Проверяем отправлен ли запрос на регистрацию
		if(null!==$this->input->post('add')){
			$this->load->library('form_validation');
			$check = $this->form_validation->run('add_new_admin');

			//Проверям валидацию
			if($check){
				$add_data["admin_name"] = $this->input->post('name');
				$add_data["admin_email"] = $this->input->post('email');
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
	*	Страница редактирования товара
	*/
	public function editinfo($id){
		//Проверяем отправлен ли запрос на регистрацию
		$id = intval($id);
		$admin_info = $this->admins_model->get_admin_all_data($id);
		if(isset($admin_info["error"])){
			show_404("нет такого админа");
		}
		var_dump($admin_info);
		$admin_info = $admin_info["data"];
		if(null!==$this->input->post('edit')){
			$this->load->library('form_validation');
			$check = $this->form_validation->run('edit_admin');
			//Проверям валидацию
			if($check){
				$edit_data["admin_name"] = $this->input->post('name');
				$edit_data["admin_email"] = $this->input->post('email');
				$edit_data["admin_is_active"] = $this->input->post('is_active');
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
	*	Страница редактирования товара
	*/
	public function editpass($id){
		//Проверяем отправлен ли запрос на регистрацию
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
	*	callback функция валидации уникальности email
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
