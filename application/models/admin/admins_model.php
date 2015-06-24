<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admins_model extends CI_Model {

	/*
	*	Получение количества администраторов
	*/
	public function get_admins_count(){
		$count = $this->db->count_all_results('admin_users');
		return $count;
	}


	/*
	*	Получение списка админов
	*	@param int $num - количество админов на странице
	*	@param int $offset - смещение
	*/
	public function get_admins($num,$offset){

		$num = intval($num);
		$offset = intval($offset);

		$firms = $this->db->order_by('admin_id','desc')
										->get('admin_users',$num,$offset)
										->result_array();

		if(empty($firms)){
			return array("error" => "нет админов");
		}else{
			return array("data" => $firms);
		}

	}

	/*
	*    Формирование и инициализация массива опций пагинатора
	*    @param int $per_page - колчество комментариев на странице
	*    @param int $page - текущий номер страницы
	*/
	function set_pagination($per_page,$page){
		$per_page = intval($per_page);
		$page = intval($page);
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admin/admins';
		$config['per_page'] =$per_page;
		$config['cur_page'] = $page;
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'Вначало';
		$config['last_link'] = 'Последняя';
		$config['next_link'] = '&gt;';
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->get_admins_count();
		$this->pagination->initialize($config);
	}

}
