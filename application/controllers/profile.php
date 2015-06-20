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

		$this->data["form"] = $this->load->view("account/form_register",$this->data,true);


		$this->data["client_info"] = $client_info;
		$this->data["profile_page"] = $this->load->view('profile/form_edit_profile',$this->data,TRUE);
		$this->data["current"] = "info";
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
		}
		$orders_details = $this->profile_model->get_orders_detail($orders);
		if(isset($orders_details["error"])){
			$orders_details = array();
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

}
