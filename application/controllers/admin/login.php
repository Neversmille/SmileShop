<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller{

	public function __construct(){

        parent::__construct();
    }

	public function index() {
		//Проверяем авторизован ли пользователь
		if (!$this->session->userdata('admin')) {

			//Проверяем нажата отправлен ли запрос на авторизацию
			if(null!==$this->input->post('admin-login')){
				$this->load->library('form_validation');
				$this->load->model('rules_model');
				$this->form_validation->set_rules($this->rules_model->admin_login_erorrs());
				$check = $this->form_validation->run('admin_login');

				//Проверяем успешность валидации
				if($check){
					//Получаем введенные пользователем данные прошедшие валидацию и фильтры
					$admin_email = $this->input->post('email');
					$admin_password = $this->input->post('password');
					$this->load->model('admin/login_admin_model');
					//Пытаемся авторизировать
					$admin_auth = $this->login_admin_model->admin_auth($admin_email,$admin_password);
					// var_dump($admin_auth);die();
					if(isset($admin_auth["data"])){
						redirect('/admin');
					}else{
						$this->data["auth_error"] = "<p class='color'>Неверный логин или пароль</p>";
					}

				}

			}
		}
		$this->load->view('admin/login',$this->data);
	}

	public function logout(){
		$this->session->unset_userdata("admin");
		redirect('/admin');
	}

}
