<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slider_admin_model extends CI_Model {

	/*
	*	Получение всех слайдов
	*/
	public function get_slides($num,$offset){
		$num = intval($num);
		$offset = intval($offset);

		$slides = $this->db->order_by('slider_is_active','desc')
								->order_by('slider_position','asc')
								->get('slider',$num,$offset)
								->result_array();

		if(empty($slides)){
			return array("error" => "не слайдов");
		}else{
			return array("data" => $slides);
		}
	}

	public function get_slide_info($id){
		$id = intval($id);

		$slide_info = $this->db->where('slider_id',$id)
									->get('slider')
									->result_array();

		if(empty($slide_info)){
			return array("error" => "не слайдов");
		}else{
			return array("data" => $slide_info[0]);
		}
	}

	/*
	*	Получени информации о товаре по id
	*	@param int $id
	*/
	public function get_product_info($id){
		$id = intval($id);

		$product_info = $this->db->where('product_id',$id)
										->get('products')
										->result_array();

		if (empty($product_info)){
			return array("error" => "нет такого товара");
		}else{
			return array("data" => $product_info[0]);
		}

	}

	/*
	*	Добавление нового слайда
	*	@param array $insert
	*/
	public function add_slide($insert){
		if(!is_array($insert)){
			return array("error" => "неверный тип аргументов");
		}
		$add_slide = $this->db->insert("slider",$insert);
		if ($add_slide){
			return array("data" => true);
		}else{
			return array("error" => "ошибка добавления слайда");
		}
	}

	public function edit_slide($id,$insert){
		$id = intval($id);
		if(!is_array($insert)){
			return array("error" => "неверный тип аргументов");
		}
		$edit_slide = $this->db->where("slider_id",$id)
									->update("slider",$insert);
		if ($edit_slide){
			return array("data" => true);
		}else{
			return array("error" => "ошибка добавления слайда");
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
		$config['base_url'] = base_url().'admin/slider';
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
		$config['total_rows'] = $this->get_slides_count();
		$this->pagination->initialize($config);
	}

	/*
	*    Получений общего количества комментариев
	*    @return int - количество комментариев в БД
	*/
	function get_slides_count(){
		return $this->db->count_all_results('slider');
	}

}
