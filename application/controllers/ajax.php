<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller{

	/*
	*	@param	string $action - выполняемое действие
	*/
	public function index($action) {

		$this->output->set_content_type('application/json');
		
		$id = $this->input->post("id");
		$amount = $this->input->post("amount");

		if (!preg_match("/(^[0-9]+)/", $id.$amount)){
			$this->output->set_output(json_encode(array(false)));
		}else{

			$this->load->model('ajax_model');
			if ($action == "add"){
				$this->ajax_model->add_basket($id,$amount);
			}elseif ($action == "update"){
				$this->ajax_model->update_basket($id,$amount);
			}elseif ($action == "delete"){
				$this->ajax_model->delete_basket($id);
			}else{
				$this->output->set_output(json_encode(array(false)));
			}

		}

	}

}
