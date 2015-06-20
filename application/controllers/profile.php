<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller{


	public function index(){

		$this->check_auth();
		$client_info =  $this->session->userdata("account");
		//Проверяем нажата ли кнопка регистрации
		if(null!==$this->input->post('update')){
			$this->load->library('form_validation');
			$this->load->model('rules_model');
			$this->form_validation->set_rules($this->rules_model->profile_errors());
			$check = $this->form_validation->run('profile');

			//Проверям валидацию
			if($check){
				$client_info["client_name"] = $this->input->post('name');
				$client_info["client_lastname"] = $this->input->post('lastname');
				$client_id = $client_info["client_id"];
				$this->load->model('account_model');
				$update_client = $this->account_model->update_client($client_id, $client_info);
				if(isset($update_client["error"])){
					show_404("ошибка обновления данных");
				}
				// обновляем данные сессии пользователя
				$client_set_auth = $this->account_model->client_set_auth($client_info);
				if(isset($client_set_auth["error"])){
					show_404("ошибка обновления данных");
				}
				redirect($this->uri->uri_string());
			}
		}

		$this->data["client_info"] = $client_info;
		$this->data["profile_page"] = $this->load->view('profile/form_edit_profile',$this->data,TRUE);
		$this->data["current"] = "info";
		$this->data["title"] = "Личный кабинет";
		$this->middle = 'profile/index';
		$this->layout();
	}

	public function security(){
		$this->check_auth();
		$client_info =  $this->session->userdata("account");

		if(null!==$this->input->post('changepass')){
			$this->load->library('form_validation');
			$this->load->model('rules_model');
			$this->form_validation->set_rules($this->rules_model->changepass_errors());
			$check = $this->form_validation->run('changepass');
			//Проверям валидацию
			if($check){
				$this->load->model('account_model');
				$newpass = $this->input->post('newpass');
				$update_client = $this->account_model->update_client_pass($client_info["client_id"], $newpass);
				if(isset($update_client_pass["error"])){
					show_404("ошибка обновления пароля");
				}
				$this->account_model->send_email($client_info["client_email"],$newpass);
				$this->data["changepass"] = true;
				// redirect($this->uri->uri_string());
			}
		}

		$this->data["client_info"] = $client_info;
		$this->data["profile_page"] = $this->load->view('profile/form_change_pass',$this->data,TRUE);
		$this->data["current"] = "security";
		$this->data["title"] = "Личный кабинет";
		$this->middle = 'profile/index';
		$this->layout();

	}

	/*
	*	Страница истории заказов
	*/
	public function history(){
		$this->check_auth();
		$client_info =  $this->session->userdata("account");
		$client_id = $client_info["client_id"];
		$this->load->model('profile_model');
		$orders = $this->profile_model->get_orders_history($client_id);
		if (isset($orders["error"])){
			$orders = array();
		}else{
			$orders = $orders["data"];
		}
		$orders_details = $this->profile_model->get_orders_detail($orders);
		if(isset($orders_details["error"])){
			$orders_details = array();
		}else{
			$orders_details = $orders_details["data"];
		}
		$this->data["orders_history"] = $orders_details;
		$this->data["orders"] =$orders;
		$this->data["current"] = "history";
		$this->data["profile_page"] = $this->load->view('profile/order_history',$this->data,TRUE);
		array_push($this->js, 'profile.js');
		$this->middle = 'profile/index';
		$this->layout();

	}



	//Проверка авторизации пользователя
	private function check_auth(){
		if (!$this->data["login_status"]) {
			$this->data["title"] = "Личный кабинет";
			$this->middle = 'profile/need_auth';
			$this->layout();
		}else{
			return true;
		}
	}

	/*
	*	callback функция валидации уникальности email
	*/
	public function check_pass($pass){
		$client_info =  $this->session->userdata("account");
		$client_id = $client_info["client_id"];
		$this->load->model("account_model");
		$check = $this->account_model-> check_client_pass($client_id,$pass);
		if(isset($check["data"])) {
			return true;
		}else{
			$this->form_validation->set_message('check_pass', 'Неверный пароль');
			return false;
		}
	}

}
