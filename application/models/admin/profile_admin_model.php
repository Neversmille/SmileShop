<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile_admin_model extends CI_Model {

	/*
	*	Получени информации о администраторе
	*	@param int $admin_id
	*/
	public function get_admin_data($admin_id){
		$admin_id = intval($admin_id);
		$admin_data = $this->db->select('admin_email,admin_name')
										->where('admin_id',$admin_id)
										->get('admin_users')
										->result_array();
		if(empty($admin_data)){
			return array("error" => "нет такого администратора");
		}else{
			return array("data" => $admin_data[0]);
		}
	}

	public function check_admin_pass($admin_id,$pass) {
        $admin_id = intval($admin_id);
        $admin_data = $this->db->where("admin_id",$admin_id)
                        				->get('admin_users')
                        				->result_array();
        if(empty($admin_data)){
            return array("error" => "админа с таким id нет");
        }else {
			$db_pass = $admin_data[0]["admin_password"];
			$this->load->library('passwordhash');
			if($this->passwordhash->CheckPassword($pass,$db_pass)){
				return array("data" => true);
			}else{
				return array("error" => "неверный пароль");
			}
        }
    }

	public function update_admin_pass($admin_id,$newpass){
		$admin_id = intval($admin_id);
		$this->load->library('passwordhash');
		$newpass = $this->passwordhash->HashPassword($newpass);
		$update = $this->db->where('admin_id', $admin_id)
								->set('admin_password',$newpass)
								->update('admin_users');

		if($update){
			return array("data" => "пароль обновлен");
		}else{
			return array("error" => "ошибка обновления данных");
		}
	}

	public function update_admin_info($admin_id,$data){
		$admin_id = intval($admin_id);
		if(!is_array($data)){
			return array("error" => "неверный тип аргумента");
		}
		$update = $this->db->where('admin_id',$admin_id)
								->update('admin_users',$data);
		if($update){
			$this->update_admin_session($admin_id);
			return array("data" =>true);
		}else{
			return array("error" => "ошибка обновления данных");
		}
	}

	public function update_admin_session($admin_id){
		$admin_id = intval($admin_id);
		$admin_data = $this->get_admin_data($admin_id);
		if(isset($admin_data["error"])){
			show_404("произошла непредвиденная ошибка");
		}
		$admin_data = $admin_data["data"];
		$this->session->set_userdata(array("admin" => array("admin_name" => $admin_data["admin_name"],
													"admin_id" => $admin_id)));
	}


}
