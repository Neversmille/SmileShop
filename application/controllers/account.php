<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller{

	function __construct(){

		parent::__construct();
		$this->load->library('passwordhash');
		$this->load->library('form_validation');
		$this->load->model('account_model');
		$this->load->model('rules_model');

	}

	public function index(){

		show_404();

	}

	/*
	*	Регистрация пользователя
	*/
	public function register(){

		//Проверяем авторизирован ли пользователь
		if (!$this->check_login_status()) {

			//Проверяем отправлен ли запрос на регистрацию
			if(null!==$this->input->post('register')){
				//Устанавливаем сообщения для валидация
				$this->form_validation->set_rules($this->rules_model->register_errors());
				$check = $this->form_validation->run('register');

				//Проверям валидацию
				if($check){
					//Формируем массив клиентских данных, прошедшых валидацию и фильтры
					$client_data["client_name"] = $this->input->post('name');
					$client_data["client_lastname"] = $this->input->post('lastname');
					$client_data["client_email"] = $this->input->post('email');
					$client_data["client_password"] = $this->passwordhash->HashPassword($this->input->post('password'));

					//Вносим пользователя в БД, авторизируем его и отправляем письмо с данными регистрации
					$add_client = $this->account_model->add_client($client_data);
					if (isset($add_client["error"])){
						show_404("Ошибка регистрации аккаунта");
					}
					$client_auth = $this->account_model->client_auth($client_data["client_email"],$this->input->post('password'));
					if (isset($client_auth["error"])){
						show_404("Ошибка авторизации");
					}
					$this->account_model->send_email($client_data["client_email"],$this->input->post('password'));
					redirect($this->uri->uri_string());
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
		if (!$this->check_login_status()) {

			//Проверяем нажата отправлен ли запрос на авторизацию
			if(null!==$this->input->post('login')){
				$this->form_validation->set_rules($this->rules_model->login_erorrs());
				$check = $this->form_validation->run('login');

				//Проверяем успешность валидации
				if($check){
					//Получаем введенные пользователем данные прошедшие валидацию и фильтры
					$client_email = $this->input->post('email');
					$client_password = $this->input->post('password');

					//Пытаемся авторизировать
					$client_auth = $this->account_model->client_auth($client_email,$client_password);
					if(isset($client_auth["data"])){
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

		$code = $this->input->get('code',true);

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

		//Проверяем существует ли пользователь с таким  id
		$check_soc_id = $this->account_model->check_soc_id($getToken->user_id);
		if(isset($check_soc_id["data"])){
			$auth = $this->account_model->soc_client_auth($getToken->user_id);
			if(isset($auth["error"])){
				show_404("Ошибка авторизации");
			}
		}else{
			//Генерируем пароль при помощь собственной функции
			$this->load->helper('passgenerate');
			$password = generatePassword();

			//Формируем массив с данными пользователя
			$client_data["client_name"] = $userInfo->first_name;
			$client_data["client_lastname"] = $userInfo->last_name;
			$client_data["client_email"] = $getToken->email;
			$client_data["client_password"] = $this->passwordhash->HashPassword($password);
			$client_data["client_type"] = "social";
			$client_data["client_soc_id"] = $getToken->user_id;

			//Регистрируем, авторизируем пользователя и отправляем данные о регистрации на его почту
			$add_client = $this->account_model->add_client($client_data);
			if (isset($add_client["error"])){
				show_404("Ошибка добавления пользователя с таким vk");
			}
			$auth = $this->account_model->soc_client_auth($getToken->user_id);
			if (isset($auth["error"])){
				show_404("Ошибка авторизации пользователя");
			}
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

	/*
	*	Проверка статуса авторизации и наличия товара в корзине
	*/
	private function check_login_status(){
		if ($this->data["login_status"]) {
			if ($this->session->userdata("basket")){
				$this->data["continue_order"] = true;
			}else{
				$this->data["continue_order"] = false;
			}
			$this->data["form"] = $this->load->view("account/already_auth",$this->data,true);
			return true;
		}else{
			return false;
		}
	}

	/*
	*	callback функция валидации уникальности email
	*/
	public function unique_email($email){
		$check = $this->account_model->check_email($email);
		if(isset($check["data"])) {
			return true;
		}else{
			$this->form_validation->set_message('unique_email', 'Пользователь с таким eMail уже зарегистрирован');
			return false;
		}
	}

}
