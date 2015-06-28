<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends MY_Controller{

	public function __construct(){
        parent::__construct();
		$admin = $this->session->userdata('admin');
		if($admin["allow_reviews"]!=1){
			redirect('/admin/index/denied');
		}
    }

	public function index($current_page="null") {
		$this->load->model('admin/reviews_admin_model');

		//Опции для пагинатора
		$per_page =10;
		$page = intval($current_page);
		if($page == 0){
			$offset =0;
		} else{
			$offset = ($page-1)*$per_page;
		}

		$reviews = $this->reviews_admin_model->get_reviews($per_page,$offset);
		if (isset($reviews["error"])){
			$reviews = array();
		}else{
			$reviews = $reviews["data"];
		}
		$this->reviews_admin_model->set_pagination($per_page,$page);

		$this->data["reviews"] = $reviews;
		$this->data["middle"] = $this->load->view("admin/reviews/reviews",$this->data,true);
		$this->data["title"] = "Отзывы";
		$this->admin_layout();
	}


	/*
	*	Страница редактирования товара
	*/
	public function review($id = null){
		if(is_null($id)) {
			show_404("Запрашиваемый комментарий не найден");
		}
		$this->load->model('admin/reviews_admin_model');
		//Проверяем отправлен ли запрос на регистрацию
		if(null!==$this->input->post('update_review')){
			$this->load->library('form_validation');
			$check = $this->form_validation->run('admin_review');
			//Проверям валидацию
			if($check){
				$review_id = $this->input->post('review_id');
				$review_status = $this->input->post('review_is_delete');
				$update_review = $this->reviews_admin_model->update_review($review_id,$review_status);
					if (isset($update_review["error"])){
						show_404("ошибка обновления комментария");
					}
					redirect('/admin/reviews/');
			}
		}
		$review_info = $this->reviews_admin_model->get_review_info_by_id($id);
		if (isset($review_info["error"])){
			show_404("Запрашиваемая фирма не найдена");
		}
		$review_info = $review_info["data"];
		$this->load->helper('form');
		$this->data["review_info"] = $review_info;
		$this->data["middle"] = $this->load->view("admin/reviews/review_info",$this->data,true);
		$this->data["title"] = "Редактирование отзыва";
		$this->admin_layout();
	}

	/*
	*	Callback проверки review_is_delete
	*	@param int $value
	*/
	public function check_review_select($value){
		$value = intval($value);
		if($value===1||$value===0){
			return true;
		}else{
			return false;
		}
	}

}
