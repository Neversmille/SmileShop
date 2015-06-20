<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller{

	/*
	*	@param	string $action - выполняемое действие
	*/
	public function index($action) {

		$this->output->set_content_type('application/json');

			$this->load->model('ajax_model');
			if ($action == "add"){
				$id = $this->input->post("id",true);
				$amount = $this->input->post("amount",true);
				$this->ajax_model->add_basket($id,$amount);
			}elseif ($action == "update"){
				$id = $this->input->post("id",true);
				$amount = $this->input->post("amount",true);
				$this->ajax_model->update_basket($id,$amount);
			}elseif ($action == "delete"){
				$id = $this->input->post("id",true);
				$this->ajax_model->delete_basket($id);
			}elseif ($action == "catalog_show_more"){
				$num = $this->input->post("per_page",true);
				$offset = $this->input->post("offset",true);
				$category_id = $this->input->post("category_id",true);
				$order = $this->input->post("order",true);
				$filter = array();
				if ($this->input->post("firm")) {
					$filter["product_firm"] = $this->input->post("firm",true);
				}
				$this->ajax_model->catalog_show_more($num,$offset,$category_id,$order,$filter);
			}elseif ($action == "reviews_show_more"){
				$num = $this->input->post("num",true);
				$offset = $this->input->post("offset",true);
				$this->ajax_model->reviews_show_more($num,$offset);
			}else{
				$this->output->set_output(json_encode(array(false)));
			}



	}

}
