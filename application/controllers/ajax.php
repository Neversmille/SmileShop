<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller{

	/*
	*	@param	string $action - выполняемое действие
	*/
	public function index($action) {

		$this->output->set_content_type('application/json');

			$this->load->model('ajax_model');
			if ($action == "add"){
				$id = $this->input->post("id");
				$amount = $this->input->post("amount");
				$this->ajax_model->add_basket($id,$amount);
			}elseif ($action == "update"){
				$id = $this->input->post("id");
				$amount = $this->input->post("amount");
				$this->ajax_model->update_basket($id,$amount);
			}elseif ($action == "delete"){
				$id = $this->input->post("id");
				$this->ajax_model->delete_basket($id);
			}elseif ($action == "catalog_show_more"){
				$num = $this->input->post("per_page");
				$offset = $this->input->post("offset");
				$category_id = $this->input->post("category_id");
				$order = $this->input->post("order");
				$filter = $this->input->post("filter");
				$this->ajax_model->catalog_show_more($num,$offset,$category_id,$order,$filter);
			}else{
				$this->output->set_output(json_encode(array(false)));
			}



	}

}
