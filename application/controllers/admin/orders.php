<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends MY_Controller{

	public function __construct(){

        parent::__construct();
		$admin = $this->session->userdata('admin');
		if($admin["allow_orders"]!=1){
			redirect('/admin/index/denied');
		}
    }

	public function index($current_page="null") {
		$this->load->model('admin/orders_admin_model');
		//Опции для пагинатора
		$per_page = 10;
		$page = intval($current_page);
		if($page == 0){
			$offset =0;
		} else{
			$offset = ($page-1)*$per_page;
		}
		$orders = $this->orders_admin_model->get_orders($per_page,$offset);
		if (isset($orders["error"])){
			$orders = array();
		}else{
			$orders = $orders["data"];
		}

		$this->orders_admin_model->set_pagination($per_page,$page);

		$this->data["orders"] = $orders;
		$this->data["middle"] = $this->load->view("admin/orders/index",$this->data,true);
		$this->data["title"] = "Заказы";
		$this->admin_layout();
	}

	/*
	*	Страница редактирования товара
	*/
	public function edit($id= null){
		if(is_null($id)) {
			show_404("Запрашиваемый заказ не найден");
		}
		$id = intval($id);
		$this->load->model('admin/orders_admin_model');
		//Проверяем отправлен ли запрос на регистрацию
		if(null!==$this->input->post('order_edit')){
			$this->load->library('form_validation');
			$check = $this->form_validation->run('edit_order');
			//Проверям валидацию
			if($check){
				$status = $this->input->post('order_status');
				$order_edit = $this->orders_admin_model->update_order($id,$status);
					if (isset($order_edit["error"])){
						show_404("ошибка добавления комментария");
					}
					redirect('/admin/orders');
			}
		}

		$order_info = $this->orders_admin_model->get_order_info_by_id($id);
		if (isset($order_info["error"])){
			show_404("Запрашиваемая фирма не найдена");
		}
		$order_info = $order_info["data"];
		$order_products = $this->orders_admin_model->get_order_products($id);
		if (isset($order_products["error"])){
			show_404("Запрашиваемая фирма не найдена");
		}
		$order_products = $order_products["data"];
		$this->data["order_products"] = $order_products;
		$this->load->helper('form');
		$this->load->library('table');
		$this->data["order_info"] = $order_info;
		$this->data["middle"] = $this->load->view("admin/orders/order_edit_form",$this->data,true);
		$this->data["title"] = "Редактирование фирмы";
		$this->admin_layout();
	}

	function check_status($status){
		$status = intval($status);
		if(preg_match('/^[0-3]$/',$status)){
			return true;
		}else{
			$this->form_validation->set_message('check_status', 'Неверный формат статуса');
			return false;
		}
	}



}
