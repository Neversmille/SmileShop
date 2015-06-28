<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Firms_admin_model extends CI_Model {

	/*
	*	Получение количества фирм
	*/
	public function get_firms_count(){
		$count = $this->db->count_all_results('firms');
		return $count;
	}

	/*
	*	Получение списка фирм
	*	@param int $num - количество фирм на странице
	*	@param int $offset - смещение
	*/
	public function get_firms($num,$offset){
		$num = intval($num);
		$offset = intval($offset);

		$firms = $this->db->order_by('firm_id','desc')
								->get('firms',$num,$offset)
								->result_array();

		if(empty($firms)){
			return array("error" => "нет фирм");
		}else{
			return array("data" => $firms);
		}
	}

	/*
	*	Добавление фирмы
	*	@pararm array $add_data
	*/
	public function add_firm($add_data){
		if(!is_array($add_data)){
			return array("error" => "неверный тип аргумента");
		}

		if($this->db->insert("firms",$add_data)){
			return array("data" => true);
		}else{
			return array("error" => "ошибка добавления товара");
		}
	}

	/*
	*	Обновление данных о фирме
	*	@param int $firm_id
	*	@param array $update_data
	*/
	public function update_firm($firm_id,$update_data){
		$firm_id = intval($firm_id);
		if(!is_array($update_data)){
			return array("error" => "неверный тип аргумента");
		}

		$update = $this->db->where('firm_id', $firm_id)
								->update('firms', $update_data);
		if($update){
			return array("data" => "фирма обновлен");
		}else{
			return array("error" => "ошибка обновления фирмы");
		}
	}

	/*
	*	Получение данных о фирме по имени
	*	@param string $name
	*/
	public function get_firm_info_by_name($name){
		if(!is_string($name)){
			return array("error" => "неверный аргумент");
		}

		$firm_info = $this->db->where('firm_name',$name)
									->get('firms')
									->result_array();

		if(empty($firm_info)) {
			return array("error" => "нет такой фирмы");
		}else{
			return array("data" => $firm_info[0]);
		}
	}


	/*
	*    Формирование и инициализация массива опций пагинатора
	*    @param int $per_page
	*    @param int $page
	*/
	function set_pagination($per_page,$page){
		$per_page = intval($per_page);
		$page = intval($page);
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admin/firms';
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
		$config['total_rows'] = $this->get_firms_count();
		$this->pagination->initialize($config);
	}

	/*
	*	Проверка уникальности имени фирмы
	*	@param string $name
	*/
	public function check_unique_name($name){
		if(!is_string($name)){
			return array("error" => "неверный аргумент");
		}

		$name_count = $this->db->where('firm_name',$name)
										->count_all_results('firms');

		if($name_count == 0) {
			return array("data" => true);
		}else{
			return array("error" => "name занят");
		}
	}


	/*
	*	Проверка уникальности url адресса и соответсвия его заданному id
	*	@param int $id
	*	@param string $url
	*/
	public function check_unique_edit_name($id,$name){
		$id = intval($id);
		if (!is_string($name)){
			return array("error" => "name должно быть строкой");
		}

		$id_name = $this->db->where("firm_id",$id)
									->where("firm_name",$name)
									->count_all_results('firms');

		if ($id_name === 1){
			return array("data" => true);
		}else{
			$check_name = $this->check_unique_name($name);
			if (isset($check_name["error"])){
				return  array("error" => "name занят");
			}else{
				return array("data" => true);
			}
		}
	}

}
