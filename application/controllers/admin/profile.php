<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller{

	public function index() {

		$admin_info = $this->session->userdata('admin');
		$admin_id = $admin_info["admin_id"];
		$this->load->model('admin/profile_admin_model');
		$admin_data = $this->profile_admin_model->get_admin_data($admin_id);
		if(isset($admin_data["error"])){
			show_404();
		}
		$admin_data = $admin_data["data"];
		$this->data["admin"] = $admin_data;
		$this->data["middle"] = $this->load->view("admin/profile/index",$this->data,true);
		$this->data["title"] = "Профайл администратора";
		$this->admin_layout();

	}

	public function changepass() {

		$admin_info = $this->session->userdata('admin');
		$admin_id = $admin_info["admin_id"];
		$this->load->model('admin/profile_admin_model');
		$this->load->helper('form');

		if(null!==$this->input->post('update_pass')){
			$this->load->library('form_validation');
			$check = $this->form_validation->run('admin_update_pass');
			if($check){
				$newpass = $this->input->post('newpass');
				$pass_update = $this->profile_admin_model->update_admin_pass($admin_id,$newpass);
				if(isset($pass_update["error"])){
					show_404("произошла ошибка");
				}else{
					redirect('/admin/profile');
				}
			}
		}


		$this->data["admin_id"] = $admin_id;
		$this->data["middle"] = $this->load->view("admin/profile/changepass",$this->data,true);
		$this->data["title"] = "Профайл администратора";
		$this->admin_layout();

	}

	public function changeinfo() {

		$admin_info = $this->session->userdata('admin');
		$admin_id = $admin_info["admin_id"];
		$this->load->model('admin/profile_admin_model');
		$this->load->helper('form');

		if(null!==$this->input->post('update_info')){
			$this->load->library('form_validation');
			$check = $this->form_validation->run('admin_update_info');
			if($check){
				$data["admin_name"] = $this->input->post('name');
				$update_info = $this->profile_admin_model->update_admin_info($admin_id,$data);
				if(isset($update_info["error"])){
					show_404("произошла ошибка");
				}else{
					redirect('/admin/profile');
				}
			}
		}


		$this->data["admin_info"] = $admin_info;
		$this->data["middle"] = $this->load->view("admin/profile/changeinfo",$this->data,true);
		$this->data["title"] = "Профайл администратора";
		$this->admin_layout();

	}


	public function check_pass($pass) {
		$admin_info = $this->session->userdata('admin');
		$admin_id = $admin_info["admin_id"];
		$this->load->model('admin/profile_admin_model');
		$check = $this->profile_admin_model->check_admin_pass($admin_id,$pass);
		if(isset($check["data"])) {
			return true;
		}else{
			$this->form_validation->set_message('check_pass', 'Неверный пароль');
			return false;
		}
	}

}
