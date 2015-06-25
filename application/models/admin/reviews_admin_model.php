<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reviews_admin_model extends CI_Model {

    /*
    *    Получение всех отзывов из базы данных
    *    @param int $num - количество
    *    @param int $offset - сдвиг
    */
    function get_reviews($num,$offset){
        $num = intval($num);
        $offset = intval($offset);
        $result = $this->db ->order_by('review_id', 'desc')
                                    ->get('reviews',$num,$offset)
                                    ->result_array();
         if(empty($result)){
             return array("error" => "комментариев нет");
         }else{
             return array("data" => $result);
         }
    }

    public function get_review_info_by_id($id){
        $id = intval($id);
        $review_info = $this->db->where("review_id",$id)
                                            ->get('reviews')
                                            ->result_array();
        if(empty($review_info)){
            return array("error" => "нет комментария с таким id");
        }else{
            return array("data" => $review_info[0]);
        }

    }

    /*
    *   Обновление статуса комментария
    *   @param int $review_id
    *   @param int $review_status
    */
    public function update_review($review_id,$review_status){
        $review_id = intval($review_id);
        $review_status = intval($review_status);
        $review_update = $this->db->where("review_id",$review_id)
                                                ->set('review_is_delete',$review_status)
                                                ->update('reviews');
        if($review_update){
            return array("data" => true);
        }else{
            return array("error" => "ошибка обновления статуса отзыва");
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
		$config['base_url'] = base_url().'admin/reviews';
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
		$config['total_rows'] = $this->get_reviews_count();
		$this->pagination->initialize($config);
	}


	/*
	*    Получений общего количества комментариев
	*    @return int - количество комментариев в БД
	*/
	function get_reviews_count(){
		return $this->db->count_all_results('reviews');
	}

}
