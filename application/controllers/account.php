<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller{

	function __construct()
    {
        parent::__construct();
	   $this->load->library('passwordhash');
    }

	public function index(){

	}

	/*
	*	Регистрация пользователя
	*/
	public function register(){


		//Проверяем авторизирован ли пользователь
		if ($this->data["login_status"]) {
			$this->data["continue_order"] = $this->session->userdata("basket");
			$this->data["form"] = $this->load->view("account/already_auth",$this->data,true);
		}else{
			$this->load->model('account_model');

			//Проверяем нажата ли кнопка регистрации
			if(null!==$this->input->post('register')){

				$this->load->library('form_validation');
				$this->load->model('rules_model');
				$this->form_validation->set_rules($this->rules_model->register_rules);
				$this->form_validation->set_rules($this->rules_model->register_errors());
				$check = $this->form_validation->run();

				//Проверям валидацию
				if($check){
					$client_data["client_name"] = $this->input->post('name');
					$client_data["client_lastname"] = $this->input->post('lastname');
					$client_data["client_email"] = $this->input->post('email');
					$client_data["client_password"] = $this->passwordhash->HashPassword($this->input->post('password'));

					//Проверяем не занята ли почта
					if($this->account_model->check_email($client_data["client_email"])){
						$this->data["mail_error"] = "<p class='color'>Пользователь с таким email уже существует<p>";
					}else{
						$this->account_model->add_client($client_data);
						$this->account_model->client_auth($client_data["client_email"],$this->input->post('password'));
						$this->account_model->send_email($client_data["client_email"],$this->input->post('password'));
						redirect($this->uri->uri_string());
					}
				}
			}

			$this->data["form"] = $this->load->view("account/form_register",$this->data,true);
		}

		$this->data["title"] = "Регистрация";
		$this->middle = 'account/register';
		$this->layout();

	}

	/*
	*	Авторизация пользователя
	*/
	public function login() {

		//Проверяем авторизован ли пользователь
		if ($this->data["login_status"]) {
			$this->data["continue_order"] =$this->session->userdata("basket");
			$this->data["form"] = $this->load->view("account/already_auth",$this->data,true);
		}else{

			//Проверяем нажата ли кнопка авторизации
			if(null!==$this->input->post('login')){
				$this->load->library('form_validation');
				$this->load->model('rules_model');
				$this->form_validation->set_rules($this->rules_model->login_rules);
				$this->form_validation->set_rules($this->rules_model->login_erorrs());
				$check = $this->form_validation->run();

				//Проверяем успешность валидации
				if($check){
					$client_email = $this->input->post('email');
					$client_password = $this->input->post('password');
					$this->load->model('account_model');

					//Пытаемся авторизировать
					if($this->account_model->client_auth($client_email,$client_password)){
						redirect($this->uri->uri_string());
					}else{
						$this->data["auth_error"] = "<p class='color'>Неверный логин или пароль";
					}
				}

			}

			$this->data["form"] = $this->load->view("account/form_login",$this->data,true);
		}

		$this->data["title"] = "Авторизация";
		$this->middle = 'account/login';
		$this->layout();

	}

	/*
	*	Авторизация пользователя через социальну сеть Вконтакте
	*/
	public function vk() {
		$code = $this->input->get('code');

		//Данные приложения Вконтакте
		$client_id='4937786';
		$client_secret='uHRwO7CaLGDkThbhXIBX';
		$redirect_url= base_url().'account/vk';
		$fields =  "uid,first_name,last_name,screen_name,sex,bdate,photo_big,email";

		//Подключение и инициализация класса собственной библиотеки
		$params = array("client_id" => $client_id, "client_secret" => $client_secret, "redirect_url" => $redirect_url, "code" => $code, "fields" => $fields);
		$this->load->library('vk',$params);

		//Получение информации от вк
		$getToken = $this->vk->getToken();
		$userInfo = $this->vk->getData($getToken);

		$this->load->model('account_model');

		//Проверяем существует ли пользователь с таким  id
		if($this->account_model->check_soc_id($getToken->user_id)){
			$auth = $this->account_model->soc_client_auth($getToken->user_id);
		}else{
			//Генерируем пароль при помощь собственной функции
			$this->load->helper('passgenerate');
			$password = generatePassword();

			//Формируем данные пользователя
			$client_data["client_name"] = $userInfo->first_name;
			$client_data["client_lastname"] = $userInfo->last_name;
			$client_data["client_email"] = $getToken->email;
			$client_data["client_password"] = $this->passwordhash->HashPassword($password);
			$client_data["client_type"] = "social";
			$client_data["client_soc_id"] = $getToken->user_id;

			//Регистрируем пользователя
			$this->account_model->add_client($client_data);
			$auth = $this->account_model->soc_client_auth($getToken->user_id);
			$this->account_model->send_email($client_data["client_email"],$password);
		}

		redirect(base_url()."login",'refresh');
	}

	/*
	*	Logout пользователя
	*/
	public function logout(){

		$this->session->unset_userdata("account");
		redirect(base_url(),'refresh');

	}

}
