<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reviews_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

   /*
   *    Получение всех отзывов из базы данных
   *    @param int $num - количество
   *    @param int $offset - сдвиг
   *    @return array - комментарии
   */
   function get_reviews($num,$offset){
              return  $this->db->order_by('review_id', 'desc')
                                       ->get('reviews',$num,$offset)
                                       ->result_array();
   }

   /*
   *    Добавление комментария
   *    @param array $insert - массив данных для вставки
   */
   function add_review($insert){
        $this->db->set('review_time', 'NOW()', FALSE);
        $this->db->insert('reviews', $insert);
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
