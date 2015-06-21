<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model {

	/*
	*	Авторизация администратора
	*/
	public function admin_auth($email,$password){

		$admin_info = $this->db->where('admin_email',$email)
									->get('admin_users')
									->result_array();
		if(empty($admin_info)) {
			return array("error" => "нет админа с таким email");
		}else{
			$admin_info = $admin_info[0];
			if ($password===$admin_info["admin_password"]){
				$this->session->set_userdata(array("admin" => array("admin_name" => $admin_info["admin_name"],
				 											"admin_id" => $admin_info["admin_id"])));
				return array("data" => true);
			}else{
				return array("error" => "неверный email или пароль");
			}
		}

	}

}
