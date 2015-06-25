<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reviews_model extends CI_Model {



   /*
   *    Получение всех отзывов из базы данных
   *    @param int $num - количество
   *    @param int $offset - сдвиг
   */
   function get_reviews($num,$offset){
       $num = intval($num);
       $offset = intval($offset);
       $result = $this->db->where('review_is_delete',0)
                                    ->order_by('review_id', 'desc')
                                   ->get('reviews',$num,$offset)
                                   ->result_array();
        if(empty($result)){
            return array("error" => "комментариев нет");
        }else{
            return array("data" => $result);
        }
   }

   /*
   *    Добавление комментария
   *    @param array $insert - массив данных для вставки
   */
   function add_review($insert){
       if(!is_array($insert)){
           return array("error" => "неверный тип аргументов");
       }
        $this->db->set('review_time', 'NOW()', FALSE);
        if($this->db->insert('reviews', $insert)){
            return array("data" => true);
        }else{
            return array("error" => "ошибка вставки данных");
        }
   }

   /*
   *    Получений общего количества комментариев
   *    @return int - количество комментариев в БД
   */
   function get_reviews_count(){
       return $this->db->count_all_results('reviews');
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
       $config['base_url'] = base_url().'reviews';
       $config['per_page'] =$per_page;
       $config['cur_page'] = $page;
       $config['cur_tag_open'] = '<span class="current">';
       $config['cur_tag_close'] = '</span>';
       $config['first_link'] = 'Вначало';
       $config['last_link'] = 'Последняя';
       $config['next_link'] = '&gt;';
       $config['uri_segment'] = 2;
       $config['use_page_numbers'] = TRUE;
       $config['total_rows'] = $this->reviews_model->get_reviews_count();
       $this->pagination->initialize($config);
   }

}
