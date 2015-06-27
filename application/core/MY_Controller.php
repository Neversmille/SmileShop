<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

    public $data;
    public $template  = array();
    //Базовый набор css, js;
    public $css = array('owl.carousel.css','bootstrap.min.css','flexslider.css','flexslider.css','font-awesome.min.css','red.css','sidebar-nav.css','style.css');
    public $js = array('jquery.js','bootstrap.min.js','owl.carousel.min.js','filter.js','nav.js','jquery.flexslider-min.js','respond.min.js','html5shiv.js','custom.js','ajax-basket.js');


    public function __construct(){

        parent::__construct();
        /*
        *   Проверка авторизирован ли пользователь
        */
        $this->data["login_status"] = $this->set_login_status();
        $this->data["title"] = "тайтл";
        $this->data["basket_count"] = $this->get_basket_count();
        $this->data["recent_items"] = $this->get_recent_items();
    }


    /*
    *   Загрузка layout
    */
    public function layout() {
         $this->data["css"] = $this->css;
         $this->data["js"] = $this->js;

         $this->data['search']   = $this->load->view('layouts/search', $this->data, true);
         $this->data['user_widget']   = $this->load->view('layouts/user_widget', $this->data, true);
         $this->template['header']   = $this->load->view('layouts/header', $this->data, true);
         $this->template['menu']   = $this->load->view('layouts/menu', $this->data, true);
         $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
         $this->template['footer'] = $this->load->view('layouts/footer', $this->data, true);
         $this->template['product_add'] = $this->load->view('modals/product_add',$this->data,true);
         $this->template['recent_items'] = $this->load->view('layouts/recent_items',$this->data,true);
         $this->load->view('layouts/index', $this->template);
   }

   /*
   *   Загрузка layout
   */
   public function admin_layout() {

        if ($this->check_admin_status()){
            $this->data["admin_widget"] = $this->load->view('admin/admin_widget',$this->data,true);
            $this->template['menu']   = $this->load->view('admin/layouts/menu', $this->data, true);
            $this->template['footer'] = $this->load->view('admin/layouts/footer', $this->data, true);
            $this->load->view('admin/layouts/index', $this->template);
        }else{
            redirect('/admin/login');
        }

  }

   /*
   *    Получение количества наименований в корзине
   */
   private function get_basket_count(){
       $basket = $this->session->userdata('basket');
       if ($basket) {
           $amount = 0;
           foreach ($basket as $value) {
               $amount+=$value["amount"];
           }
           return $amount ;
       }else{
           return  0;
       }
   }

   /*
   *    Установка статуса авторизации
   */
   private function set_login_status(){
       if ($this->session->userdata('account')) {
           $this->data["user_info"] = $this->session->userdata('account');
           return true;
       }else{
           return false;
       }
   }

   /*
   *	Получение последних 10 просмотренных товаров
   */
   public function get_recent_items(){
       return  $this->session->userdata('recent_items');
   }

   private function check_admin_status(){
        if ($this->session->userdata('admin')) {
            $this->data["admin_info"] = $this->session->userdata('admin');
            return true;
        }else{
            return false;
        }
   }

}
