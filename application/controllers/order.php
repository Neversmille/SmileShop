<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller{

	public function index(){
		//Проверяем статус авторизации
		if ($this->data["login_status"]) {
			$this->data["client_info"] = $this->session->userdata("account");
			$client_id = $this->data["client_info"]["client_id"];
			$client_email = $this->data["client_info"]["client_email"];
			$this->load->library('form_validation');
			$this->load->model('rules_model');
			$this->form_validation->set_rules($this->rules_model->order_errors());
			$this->data["order_block"] = $this->load->view("order/order_form",$this->data,true);

			if(null!==$this->input->post('order')){
				$check = $this->form_validation->run('order');

				if($check){
						$this->load->model('order_model');
						$basket = $this->session->userdata('basket');

						$add_order = $this->order_model->add_order($basket,$client_id,$client_email,$this->input->post('phone'),$this->input->post('text'));
						if (isset($add_order["error"])){
							$this->data["order_message"] = "Во время оформления заказа произошла ошибка =(";
						}else{
							$this->data["order_message"] = "Ваш заказ принят";
							$this->session->unset_userdata('basket');
						}

						$this->data["order_block"] = $this->load->view("order/order_complete",$this->data,true);

					}else{
						$this->data["order_block"] = $this->load->view("order/order_form",$this->data,true);
					}

			}

		}else{
			$this->data["order_message"] = true;
			$this->data["order_block"] = $this->load->view("order/need_auth",$this->data,true);
		}

		$this->data["title"] = "Оформление заказа";
		$this->middle = 'order/index';
		$this->layout();

	}

}
